import { User } from '../models/User.js';
import { AuditLog } from '../models/AuditLog.js';
import { ApiResponse } from '../utils/apiResponse.js';
import { asyncHandler } from '../utils/asyncHandler.js';
import { ApiError } from '../utils/apiError.js';
import { AuditService } from '../services/audit.service.js';

export const getAllUsers = asyncHandler(async (req, res) => {
  const users = await User.find().sort({ createdAt: -1 });
  return ApiResponse.ok(res, 'User list retrieved successfully', {
    users: users.map((u) => u.toSafeObject()),
  });
});

export const updateUserStatus = asyncHandler(async (req, res) => {
  const { userId } = req.params;
  const { status } = req.body;

  if (!['active', 'pending', 'suspended', 'disabled'].includes(status)) {
    throw ApiError.badRequest('Invalid status provided');
  }

  const user = await User.findById(userId);
  if (!user) {
    throw ApiError.notFound('User not found');
  }

  user.status = status;
  await user.save();

  await AuditService.log({
    userId: req.user.id,
    action: 'ADMIN_UPDATE_USER_STATUS',
    req,
    details: { targetUserId: userId, newStatus: status },
  });

  return ApiResponse.ok(res, `User status updated to ${status}`, {
    user: user.toSafeObject(),
  });
});

export const getAuditLogs = asyncHandler(async (req, res) => {
  const limit = parseInt(req.query.limit || '50', 10);
  const logs = await AuditLog.find()
    .populate('userId', 'name email role')
    .sort({ createdAt: -1 })
    .limit(limit);

  return ApiResponse.ok(res, 'Audit logs retrieved successfully', { logs });
});
