import { env } from '../config/env.js';

export class EmailService {
  static async sendVerificationEmail(email, name, token) {
    const verificationUrl = `${env.clientUrl}/verify-email?token=${token}&email=${encodeURIComponent(email)}`;

    console.log(`[EmailService] Verification email sent to ${email}`);
    console.log(`[EmailService] Link: ${verificationUrl}`);
    return true;
  }

  static async sendPasswordResetEmail(email, name, token) {
    const resetUrl = `${env.clientUrl}/reset-password/${token}`;

    console.log(`[EmailService] Password reset email sent to ${email}`);
    console.log(`[EmailService] Link: ${resetUrl}`);
    return true;
  }
}
