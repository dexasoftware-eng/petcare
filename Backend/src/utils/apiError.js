export class ApiError extends Error {
  constructor(statusCode, message = 'An unexpected error occurred', errors = [], isOperational = true) {
    super(message);
    this.statusCode = statusCode;
    this.errors = errors;
    this.isOperational = isOperational;
    this.success = false;
    Error.captureStackTrace(this, this.constructor);
  }

  static badRequest(msg = 'Bad request', errors = []) {
    return new ApiError(400, msg, errors);
  }

  static unauthorized(msg = 'Unauthorized access') {
    return new ApiError(401, msg);
  }

  static forbidden(msg = 'Forbidden: Access denied') {
    return new ApiError(403, msg);
  }

  static notFound(msg = 'Resource not found') {
    return new ApiError(404, msg);
  }

  static conflict(msg = 'Resource conflict') {
    return new ApiError(409, msg);
  }

  static unprocessable(msg = 'Validation failed', errors = []) {
    return new ApiError(422, msg, errors);
  }

  static tooManyRequests(msg = 'Too many requests, please try again later') {
    return new ApiError(429, msg);
  }

  static internal(msg = 'Internal server error') {
    return new ApiError(500, msg, [], false);
  }
}
