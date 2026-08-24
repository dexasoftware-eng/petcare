import jwt from 'jsonwebtoken';
import crypto from 'crypto';
import { env } from '../config/env.js';

export class TokenService {
  static generateAccessToken(user) {
    const payload = {
      sub: user._id.toString(),
      role: user.role,
      status: user.status,
    };

    return jwt.sign(payload, env.jwt.accessSecret, {
      expiresIn: env.jwt.accessExpiresIn,
    });
  }

  static generateRefreshToken(tokenId, userId) {
    const payload = {
      jti: tokenId,
      sub: userId.toString(),
    };

    return jwt.sign(payload, env.jwt.refreshSecret, {
      expiresIn: env.jwt.refreshExpiresIn,
    });
  }

  static verifyAccessToken(token) {
    try {
      return jwt.verify(token, env.jwt.accessSecret);
    } catch (err) {
      return null;
    }
  }

  static verifyRefreshToken(token) {
    try {
      return jwt.verify(token, env.jwt.refreshSecret);
    } catch (err) {
      return null;
    }
  }

  static hashToken(token) {
    return crypto.createHash('sha256').update(token).digest('hex');
  }

  static generateRandomToken() {
    const rawToken = crypto.randomBytes(32).toString('hex');
    const tokenHash = this.hashToken(rawToken);
    return { rawToken, tokenHash };
  }
}
