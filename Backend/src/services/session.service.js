import crypto from 'crypto';
import { AuthSession } from '../models/AuthSession.js';
import { TokenService } from './token.service.js';

export class SessionService {
  static async createSession(userId, ipAddress, userAgent) {
    const tokenId = crypto.randomUUID();
    const refreshToken = TokenService.generateRefreshToken(tokenId, userId);
    const refreshTokenHash = TokenService.hashToken(refreshToken);

    // Default 7 days
    const expiresAt = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000);

    const session = await AuthSession.create({
      userId,
      tokenId,
      refreshTokenHash,
      ipAddress,
      userAgent,
      expiresAt,
    });

    return { session, refreshToken };
  }

  static async rotateSession(rawRefreshToken, ipAddress, userAgent) {
    const decoded = TokenService.verifyRefreshToken(rawRefreshToken);
    if (!decoded || !decoded.jti || !decoded.sub) {
      return null;
    }

    const providedHash = TokenService.hashToken(rawRefreshToken);
    const session = await AuthSession.findOne({ tokenId: decoded.jti });

    if (!session || session.revokedAt || session.expiresAt < new Date()) {
      return null;
    }

    if (session.refreshTokenHash !== providedHash) {
      // Possible token replay attack - revoke all user sessions
      await this.revokeAllUserSessions(decoded.sub);
      return null;
    }

    // Revoke current session
    session.revokedAt = new Date();
    await session.save();

    // Create new rotated session
    return this.createSession(decoded.sub, ipAddress, userAgent);
  }

  static async revokeSessionByToken(rawRefreshToken) {
    const decoded = TokenService.verifyRefreshToken(rawRefreshToken);
    if (!decoded || !decoded.jti) return;

    await AuthSession.updateOne(
      { tokenId: decoded.jti },
      { $set: { revokedAt: new Date() } }
    );
  }

  static async revokeAllUserSessions(userId) {
    await AuthSession.updateMany(
      { userId, revokedAt: null },
      { $set: { revokedAt: new Date() } }
    );
  }
}
