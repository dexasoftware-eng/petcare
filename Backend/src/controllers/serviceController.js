import { Service } from '../models/Service.js';

// @desc    Get all services
// @route   GET /api/services
export const getServices = async (req, res) => {
  try {
    const { highlight } = req.query;
    let query = {};
    if (highlight === 'true') {
      query.isHighlight = true;
    }

    const services = await Service.find(query);
    res.status(200).json({
      success: true,
      count: services.length,
      data: services
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};

// @desc    Get service by slug/id
// @route   GET /api/services/:id
export const getServiceById = async (req, res) => {
  try {
    const { id } = req.params;
    let service;
    if (id.match(/^[0-9a-fA-F]{24}$/)) {
      service = await Service.findById(id);
    } else {
      service = await Service.findOne({ slug: id });
    }

    if (!service) {
      return res.status(404).json({ success: false, message: 'Service not found' });
    }

    res.status(200).json({ success: true, data: service });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
