import { TokenService } from '../services/token.service.js';
import { User } from '../models/User.js';
import { ApiError } from '../utils/apiError.js';
import { asyncHandler } from '../utils/asyncHandler.js';

export const authenticate = asyncHandler(async (req, res, next) => {
  let token = null;

  const authHeader = req.headers.authorization;
  if (authHeader && authHeader.startsWith('Bearer ')) {
    token = authHeader.split(' ')[1];
  }

  if (!token) {
    throw ApiError.unauthorized('Authentication required: Missing access token');
  }

  const decoded = TokenService.verifyAccessToken(token);
  if (!decoded || !decoded.sub) {
    throw ApiError.unauthorized('Invalid or expired access token');
  }

  const user = await User.findById(decoded.sub);
  if (!user) {
    throw ApiError.unauthorized('User not found');
  }

  if (user.status === 'suspended' || user.status === 'disabled') {
    throw ApiError.forbidden('Your account has been deactivated');
  }

  req.user = user.toSafeObject();
  next();
});
