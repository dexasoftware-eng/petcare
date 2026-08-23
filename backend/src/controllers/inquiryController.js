import { Inquiry } from '../models/Inquiry.js';

// @desc    Submit contact / appointment message
// @route   POST /api/inquiries
export const createInquiry = async (req, res) => {
  try {
    const { name, email, phone, service, message } = req.body;

    if (!name || !email || !message) {
      return res.status(400).json({ success: false, message: 'Name, email, and message are required' });
    }

    const inquiry = await Inquiry.create({
      name,
      email,
      phone: phone || '',
      service: service || 'Grooming',
      message
    });

    res.status(201).json({
      success: true,
      message: 'Inquiry received successfully. Our team will contact you shortly.',
      data: inquiry
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
