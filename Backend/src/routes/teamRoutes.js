import express from 'express';
import { getTeam, getTeamMemberById } from '../controllers/teamController.js';

const router = express.Router();
router.get('/', getTeam);
router.get('/:id', getTeamMemberById);

export default router;
