import { Router } from 'express';
import { AuthController } from '../controllers/auth.controller.js';
import { authenticate } from '../middleware/authenticate.js';
import { authLimiter } from '../middleware/rateLimiter.js';
import { validate } from '../middleware/validate.js';
import {
  registerOwnerValidator,
  registerVeterinarianValidator,
  registerShelterValidator,
  loginValidator,
  forgotPasswordValidator,
  resetPasswordValidator,
  verifyEmailValidator,
} from '../validators/auth.validator.js';

const router = Router();

// Public Registration
router.post(
  '/register/owner',
  authLimiter,
  validate(registerOwnerValidator),
  AuthController.registerOwner
);

router.post(
  '/register/veterinarian',
  authLimiter,
  validate(registerVeterinarianValidator),
  AuthController.registerVeterinarian
);

router.post(
  '/register/shelter',
  authLimiter,
  validate(registerShelterValidator),
  AuthController.registerShelter
);

// Public Authentication
router.post('/login', authLimiter, validate(loginValidator), AuthController.login);
router.post('/refresh', AuthController.refresh);
router.post(
  '/forgot-password',
  authLimiter,
  validate(forgotPasswordValidator),
  AuthController.forgotPassword
);
router.post(
  '/reset-password',
  authLimiter,
  validate(resetPasswordValidator),
  AuthController.resetPassword
);
router.get('/verify-email', validate(verifyEmailValidator), AuthController.verifyEmail);

// Protected Authentication
router.post('/logout', AuthController.logout);
router.post('/logout-all', authenticate, AuthController.logoutAll);
router.get('/me', authenticate, AuthController.getMe);

export default router;
