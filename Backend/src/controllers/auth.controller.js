import { AuthService } from '../services/auth.service.js';
import { VeterinarianProfile } from '../models/VeterinarianProfile.js';
import { ShelterProfile } from '../models/ShelterProfile.js';
import { asyncHandler } from '../utils/asyncHandler.js';
import { ApiResponse } from '../utils/apiResponse.js';
import { env } from '../config/env.js';

const COOKIE_OPTIONS = {
  httpOnly: true,
  secure: env.isProduction,
  sameSite: env.isProduction ? 'none' : 'lax',
  maxAge: 7 * 24 * 60 * 60 * 1000, // 7 days
  path: '/',
};

const setRefreshCookie = (res, refreshToken) => {
  res.cookie(env.cookieName, refreshToken, COOKIE_OPTIONS);
};

const clearRefreshCookie = (res) => {
  res.clearCookie(env.cookieName, {
    ...COOKIE_OPTIONS,
    maxAge: 0,
  });
};

export class AuthController {
  static registerOwner = asyncHandler(async (req, res) => {
    const { name, email, phone, address, password } = req.body;
    const { user, accessToken, refreshToken } = await AuthService.registerOwner(
      { name, email, phone, address, password },
      req
    );

    setRefreshCookie(res, refreshToken);

    return res
      .status(201)
      .json(new ApiResponse(201, { user, accessToken }, 'Owner registered successfully'));
  });

  static registerVeterinarian = asyncHandler(async (req, res) => {
    const { name, email, phone, address, password, specialization, experience } = req.body;
    const { user, accessToken, refreshToken } = await AuthService.registerVeterinarian(
      { name, email, phone, address, password, specialization, experience },
      req
    );

    setRefreshCookie(res, refreshToken);

    return res
      .status(201)
      .json(new ApiResponse(201, { user, accessToken }, 'Veterinarian registered successfully'));
  });

  static registerShelter = asyncHandler(async (req, res) => {
    const { shelterName, contactPerson, email, phone, address, password } = req.body;
    const { user, accessToken, refreshToken } = await AuthService.registerShelter(
      { shelterName, contactPerson, email, phone, address, password },
      req
    );

    setRefreshCookie(res, refreshToken);

    return res
      .status(201)
      .json(new ApiResponse(201, { user, accessToken }, 'Shelter registered successfully'));
  });

  static login = asyncHandler(async (req, res) => {
    const { email, password } = req.body;
    const { user, accessToken, refreshToken } = await AuthService.login(
      { email, password },
      req
    );

    // Attach profile if vet or shelter
    let fullUser = { ...user };
    if (user.role === 'veterinarian') {
      const profile = await VeterinarianProfile.findOne({ userId: user.id });
      fullUser.profile = profile;
    } else if (user.role === 'shelter') {
      const profile = await ShelterProfile.findOne({ userId: user.id });
      fullUser.profile = profile;
    }

    setRefreshCookie(res, refreshToken);

    return res
      .status(200)
      .json(new ApiResponse(200, { user: fullUser, accessToken }, 'Logged in successfully'));
  });

  static refresh = asyncHandler(async (req, res) => {
    const rawRefreshToken = req.cookies[env.cookieName] || req.body.refreshToken;
    const { user, accessToken, refreshToken } = await AuthService.refresh(
      rawRefreshToken,
      req
    );

    // Attach profile if vet or shelter
    let fullUser = { ...user };
    if (user.role === 'veterinarian') {
      const profile = await VeterinarianProfile.findOne({ userId: user.id });
      fullUser.profile = profile;
    } else if (user.role === 'shelter') {
      const profile = await ShelterProfile.findOne({ userId: user.id });
      fullUser.profile = profile;
    }

    setRefreshCookie(res, refreshToken);

    return res
      .status(200)
      .json(new ApiResponse(200, { user: fullUser, accessToken }, 'Session refreshed successfully'));
  });

  static logout = asyncHandler(async (req, res) => {
    const rawRefreshToken = req.cookies[env.cookieName] || req.body?.refreshToken;
    await AuthService.logout(rawRefreshToken, req.user?.id);
    clearRefreshCookie(res);

    return res
      .status(200)
      .json(new ApiResponse(200, null, 'Logged out successfully'));
  });

  static logoutAll = asyncHandler(async (req, res) => {
    await AuthService.logoutAll(req.user.id);
    clearRefreshCookie(res);

    return res
      .status(200)
      .json(new ApiResponse(200, null, 'Logged out from all devices successfully'));
  });

  static getMe = asyncHandler(async (req, res) => {
    const user = { ...req.user };
    if (user.role === 'veterinarian') {
      const profile = await VeterinarianProfile.findOne({ userId: user.id });
      user.profile = profile;
    } else if (user.role === 'shelter') {
      const profile = await ShelterProfile.findOne({ userId: user.id });
      user.profile = profile;
    }

    return res
      .status(200)
      .json(new ApiResponse(200, { user }, 'User profile retrieved successfully'));
  });

  static forgotPassword = asyncHandler(async (req, res) => {
    const { email } = req.body;
    const result = await AuthService.forgotPassword(email, req);

    return res
      .status(200)
      .json(new ApiResponse(200, null, result.message));
  });

  static resetPassword = asyncHandler(async (req, res) => {
    const { token, password } = req.body;
    const result = await AuthService.resetPassword(token, password, req);

    return res
      .status(200)
      .json(new ApiResponse(200, null, result.message));
  });

  static verifyEmail = asyncHandler(async (req, res) => {
    const { token } = req.query;
    const result = await AuthService.verifyEmail(token, req);

    return res
      .status(200)
      .json(new ApiResponse(200, null, result.message));
  });
}
