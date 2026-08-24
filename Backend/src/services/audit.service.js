import { AuditLog } from '../models/AuditLog.js';

export class AuditService {
  static async log({ userId = null, action, status = 'SUCCESS', req, details = {} }) {
    try {
      const ipAddress = req?.headers['x-forwarded-for'] || req?.socket?.remoteAddress || 'unknown';
      const userAgent = req?.headers['user-agent'] || 'unknown';

      await AuditLog.create({
        userId,
        action,
        status,
        ipAddress,
        userAgent,
        details,
      });
    } catch (error) {
      console.error(`[AuditService Error]: ${error.message}`);
    }
  }
}
