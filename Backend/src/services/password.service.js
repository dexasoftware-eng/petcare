import bcrypt from 'bcryptjs';
import { env } from '../config/env.js';

export class PasswordService {
  static async hash(password) {
    const salt = await bcrypt.genSalt(env.bcryptRounds);
    return bcrypt.hash(password, salt);
  }

  static async compare(candidatePassword, passwordHash) {
    if (!candidatePassword || !passwordHash) return false;
    return bcrypt.compare(candidatePassword, passwordHash);
  }

  static validatePolicy(password) {
    if (!password || typeof password !== 'string') {
      return { isValid: false, message: 'Password is required' };
    }

    if (password.length < 8) {
      return { isValid: false, message: 'Password must be at least 8 characters long' };
    }

    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    if (!hasUppercase || !hasLowercase || !hasNumber) {
      return {
        isValid: false,
        message: 'Password must contain at least one uppercase letter, one lowercase letter, and one number',
      };
    }

    return { isValid: true, message: 'Password meets complexity criteria' };
  }
}
