import express from 'express';
import { createOrder, getOrderByNumber } from '../controllers/orderController.js';

const router = express.Router();
router.post('/', createOrder);
router.get('/:orderNumber', getOrderByNumber);

export default router;
