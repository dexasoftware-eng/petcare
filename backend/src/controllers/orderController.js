import { Order } from '../models/Order.js';

// @desc    Create new order
// @route   POST /api/orders
export const createOrder = async (req, res) => {
  try {
    const { customer, items, subtotal, discount, total, paymentMethod } = req.body;

    if (!items || items.length === 0) {
      return res.status(400).json({ success: false, message: 'No items in order' });
    }

    const orderNumber = `PATTE-${Math.floor(100000 + Math.random() * 900000)}`;

    const order = await Order.create({
      orderNumber,
      customer,
      items,
      subtotal,
      discount: discount || 0,
      total,
      paymentMethod: paymentMethod || 'card',
      paymentStatus: 'paid',
      status: 'received'
    });

    res.status(201).json({
      success: true,
      message: 'Order created successfully',
      data: order
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};


export const getOrderByNumber = async (req, res) => {
  try {
    const { orderNumber } = req.params;
    const order = await Order.findOne({ orderNumber });

    if (!order) {
      return res.status(404).json({ success: false, message: 'Order not found' });
    }

    res.status(200).json({ success: true, data: order });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
