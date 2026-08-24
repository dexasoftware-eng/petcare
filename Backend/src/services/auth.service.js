import { User } from '../models/User.js';
import { VeterinarianProfile } from '../models/VeterinarianProfile.js';
import { ShelterProfile } from '../models/ShelterProfile.js';
import { PasswordService } from './password.service.js';
import { TokenService } from './token.service.js';
import { SessionService } from './session.service.js';
import { EmailService } from './email.service.js';
import { AuditService } from './audit.service.js';
import { ApiError } from '../utils/apiError.js';
import { env } from '../config/env.js';

export class AuthService {
  static async registerOwner({ name, email, phone, address, password }, req) {
    const normalizedEmail = email.trim().toLowerCase();
    const existing = await User.findOne({ email: normalizedEmail });
    if (existing) {
      throw ApiError.conflict('An account with this email already exists');
    }

    const passwordHash = await PasswordService.hash(password);
    const { rawToken, tokenHash } = TokenService.generateRandomToken();
    const expiresAt = new Date(Date.now() + env.emailVerificationExpiresHours * 60 * 60 * 1000);

    const user = await User.create({
      name: name.trim(),
      email: normalizedEmail,
      phone: phone.trim(),
      address: address.trim(),
      passwordHash,
      role: 'owner',
      status: 'active',
      emailVerified: false,
      emailVerificationTokenHash: tokenHash,
      emailVerificationExpiresAt: expiresAt,
    });

    await EmailService.sendVerificationEmail(user.email, user.name, rawToken);
    await AuditService.log({ userId: user._id, action: 'REGISTER_OWNER', req });

    const { refreshToken } = await SessionService.createSession(
      user._id,
      req.ip || 'unknown',
      req.headers['user-agent'] || 'unknown'
    );
    const accessToken = TokenService.generateAccessToken(user);

    return { user: user.toSafeObject(), accessToken, refreshToken };
  }

  static async registerVeterinarian({ name, email, phone, address, password, specialization, experience }, req) {
    const normalizedEmail = email.trim().toLowerCase();
    const existing = await User.findOne({ email: normalizedEmail });
    if (existing) {
      throw ApiError.conflict('An account with this email already exists');
    }

    const passwordHash = await PasswordService.hash(password);
    const { rawToken, tokenHash } = TokenService.generateRandomToken();
    const expiresAt = new Date(Date.now() + env.emailVerificationExpiresHours * 60 * 60 * 1000);

    const user = await User.create({
      name: name.trim(),
      email: normalizedEmail,
      phone: phone.trim(),
      address: address.trim(),
      passwordHash,
      role: 'veterinarian',
      status: 'active',
      emailVerified: false,
      emailVerificationTokenHash: tokenHash,
      emailVerificationExpiresAt: expiresAt,
    });

    const profile = await VeterinarianProfile.create({
      userId: user._id,
      specialization: specialization.trim(),
      experience: Number(experience),
    });

    await EmailService.sendVerificationEmail(user.email, user.name, rawToken);
    await AuditService.log({ userId: user._id, action: 'REGISTER_VETERINARIAN', req });

    const { refreshToken } = await SessionService.createSession(
      user._id,
      req.ip || 'unknown',
      req.headers['user-agent'] || 'unknown'
    );
    const accessToken = TokenService.generateAccessToken(user);

    return {
      user: { ...user.toSafeObject(), profile },
      accessToken,
      refreshToken,
    };
  }

  static async registerShelter({ shelterName, contactPerson, email, phone, address, password }, req) {
    const normalizedEmail = email.trim().toLowerCase();
    const existing = await User.findOne({ email: normalizedEmail });
    if (existing) {
      throw ApiError.conflict('An account with this email already exists');
    }

    const passwordHash = await PasswordService.hash(password);
    const { rawToken, tokenHash } = TokenService.generateRandomToken();
    const expiresAt = new Date(Date.now() + env.emailVerificationExpiresHours * 60 * 60 * 1000);

    const user = await User.create({
      name: contactPerson.trim(),
      email: normalizedEmail,
      phone: phone.trim(),
      address: address.trim(),
      passwordHash,
      role: 'shelter',
      status: 'active',
      emailVerified: false,
      emailVerificationTokenHash: tokenHash,
      emailVerificationExpiresAt: expiresAt,
    });

    const profile = await ShelterProfile.create({
      userId: user._id,
      shelterName: shelterName.trim(),
      contactPerson: contactPerson.trim(),
    });

    await EmailService.sendVerificationEmail(user.email, user.name, rawToken);
    await AuditService.log({ userId: user._id, action: 'REGISTER_SHELTER', req });

    const { refreshToken } = await SessionService.createSession(
      user._id,
      req.ip || 'unknown',
      req.headers['user-agent'] || 'unknown'
    );
    const accessToken = TokenService.generateAccessToken(user);

    return {
      user: { ...user.toSafeObject(), profile },
      accessToken,
      refreshToken,
    };
  }

  static async login({ email, password }, req) {
    const normalizedEmail = (email || '').trim().toLowerCase();
    const user = await User.findOne({ email: normalizedEmail }).select('+passwordHash');

    if (!user) {
      await AuditService.log({ action: 'LOGIN_FAILURE', status: 'FAILURE', req, details: { email: normalizedEmail } });
      throw ApiError.unauthorized('Invalid email or password');
    }

    if (user.lockedUntil && user.lockedUntil > new Date()) {
      const minutesRemaining = Math.ceil((user.lockedUntil - new Date()) / (60 * 1000));
      throw ApiError.tooManyRequests(`Account is temporarily locked. Please try again in ${minutesRemaining} minutes.`);
    }

    if (user.status === 'suspended' || user.status === 'disabled') {
      throw ApiError.forbidden('Your account has been suspended or disabled. Please contact support.');
    }

    const isMatch = await PasswordService.compare(password, user.passwordHash);
    if (!isMatch) {
      user.failedLoginAttempts += 1;
      if (user.failedLoginAttempts >= 5) {
        user.lockedUntil = new Date(Date.now() + 15 * 60 * 1000);
        user.failedLoginAttempts = 0;
      }
      await user.save();
      await AuditService.log({ userId: user._id, action: 'LOGIN_FAILURE', status: 'FAILURE', req });
      throw ApiError.unauthorized('Invalid email or password');
    }

    user.failedLoginAttempts = 0;
    user.lockedUntil = null;
    user.lastLoginAt = new Date();
    await user.save();

    const { refreshToken } = await SessionService.createSession(
      user._id,
      req.ip || 'unknown',
      req.headers['user-agent'] || 'unknown'
    );
    const accessToken = TokenService.generateAccessToken(user);

    await AuditService.log({ userId: user._id, action: 'LOGIN_SUCCESS', req });

    return { user: user.toSafeObject(), accessToken, refreshToken };
  }

  static async refresh(rawRefreshToken, req) {
    if (!rawRefreshToken) {
      throw ApiError.unauthorized('Refresh token is required');
    }

    const newSessionData = await SessionService.rotateSession(
      rawRefreshToken,
      req.ip || 'unknown',
      req.headers['user-agent'] || 'unknown'
    );

    if (!newSessionData) {
      throw ApiError.unauthorized('Invalid or expired refresh token');
    }

    const user = await User.findById(newSessionData.session.userId);
    if (!user || user.status === 'suspended' || user.status === 'disabled') {
      throw ApiError.unauthorized('User not found or account deactivated');
    }

    const accessToken = TokenService.generateAccessToken(user);
    return { user: user.toSafeObject(), accessToken, refreshToken: newSessionData.refreshToken };
  }

  static async logout(rawRefreshToken, userId) {
    if (rawRefreshToken) {
      await SessionService.revokeSessionByToken(rawRefreshToken);
    }
  }

  static async logoutAll(userId) {
    await SessionService.revokeAllUserSessions(userId);
  }

  static async forgotPassword(email, req) {
    const normalizedEmail = (email || '').trim().toLowerCase();
    const user = await User.findOne({ email: normalizedEmail });

    if (user && user.status === 'active') {
      const { rawToken, tokenHash } = TokenService.generateRandomToken();
      user.passwordResetTokenHash = tokenHash;
      user.passwordResetExpiresAt = new Date(Date.now() + env.passwordResetExpiresMinutes * 60 * 1000);
      await user.save();

      await EmailService.sendPasswordResetEmail(user.email, user.name, rawToken);
      await AuditService.log({ userId: user._id, action: 'FORGOT_PASSWORD_REQUEST', req });
    }

    // Generic safe message to prevent enumeration
    return { message: 'If an account exists with this email, a password reset link has been sent.' };
  }

  static async resetPassword(token, newPassword, req) {
    if (!token) throw ApiError.badRequest('Reset token is required');
    const tokenHash = TokenService.hashToken(token);

    const user = await User.findOne({
      passwordResetTokenHash: tokenHash,
      passwordResetExpiresAt: { $gt: new Date() },
    });

    if (!user) {
      throw ApiError.badRequest('Invalid or expired password reset link');
    }

    const passwordHash = await PasswordService.hash(newPassword);
    user.passwordHash = passwordHash;
    user.passwordResetTokenHash = null;
    user.passwordResetExpiresAt = null;
    user.passwordChangedAt = new Date();
    await user.save();

    // Invalidate all existing sessions after password change
    await SessionService.revokeAllUserSessions(user._id);
    await AuditService.log({ userId: user._id, action: 'PASSWORD_RESET_SUCCESS', req });

    return { message: 'Password reset successfully. Please log in with your new password.' };
  }

  static async verifyEmail(token, req) {
    if (!token) throw ApiError.badRequest('Verification token is required');
    const tokenHash = TokenService.hashToken(token);

    const user = await User.findOne({
      emailVerificationTokenHash: tokenHash,
      emailVerificationExpiresAt: { $gt: new Date() },
    });

    if (!user) {
      throw ApiError.badRequest('Invalid or expired verification link');
    }

    user.emailVerified = true;
    user.emailVerificationTokenHash = null;
    user.emailVerificationExpiresAt = null;
    await user.save();

    await AuditService.log({ userId: user._id, action: 'EMAIL_VERIFIED', req });
    return { message: 'Email verified successfully!' };
  }
}
