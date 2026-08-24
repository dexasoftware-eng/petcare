export class ApiResponse {
  constructor(statusCode, message = 'Success', data = null) {
    this.success = statusCode >= 200 && statusCode < 300;
    this.statusCode = statusCode;
    this.message = message;
    if (data !== null) {
      this.data = data;
    }
  }

  static ok(res, message = 'Success', data = null) {
    return res.status(200).json(new ApiResponse(200, message, data));
  }

  static created(res, message = 'Resource created successfully', data = null) {
    return res.status(201).json(new ApiResponse(201, message, data));
  }
}
