import { ApiError } from '../utils/apiError.js';
import { env } from '../config/env.js';

export const errorHandler = (err, req, res, next) => {
  let error = err;

  // Handle Mongoose Duplicate Key Error
  if (err.code === 11000) {
    const field = Object.keys(err.keyValue || {})[0] || 'field';
    error = ApiError.conflict(`An account with that ${field} already exists.`);
  }

  // Handle Mongoose Validation Error
  if (err.name === 'ValidationError') {
    const errors = Object.values(err.errors).map((e) => ({
      field: e.path,
      message: e.message,
    }));
    error = new ApiError(422, 'Database validation failed', errors);
  }

  // Handle JWT Error
  if (err.name === 'JsonWebTokenError') {
    error = ApiError.unauthorized('Invalid security token');
  }
  if (err.name === 'TokenExpiredError') {
    error = ApiError.unauthorized('Security token has expired');
  }

  const statusCode = error.statusCode || 500;
  const message = error.message || 'Internal Server Error';

  res.status(statusCode).json({
    success: false,
    message,
    errors: error.errors || [],
    ...(env.nodeEnv === 'development' && { stack: err.stack }),
  });
};
