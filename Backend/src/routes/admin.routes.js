import { Router } from 'express';
import { getAllUsers, updateUserStatus, getAuditLogs } from '../controllers/admin.controller.js';
import { authenticate } from '../middleware/authenticate.js';
import { authorize } from '../middleware/authorize.js';

const router = Router();

// All admin routes strictly require authentication and 'admin' role
router.use(authenticate, authorize('admin'));

router.get('/users', getAllUsers);
router.patch('/users/:userId/status', updateUserStatus);
router.get('/audit-logs', getAuditLogs);

export default router;
