import { Category } from '../models/Category.js';

// @desc    Get all categories
// @route   GET /api/categories
export const getCategories = async (req, res) => {
  try {
    const categories = await Category.find().sort({ title: 1 });
    res.status(200).json({
      success: true,
      count: categories.length,
      data: categories
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
