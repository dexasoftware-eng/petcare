import { Team } from '../models/Team.js';

// @desc    Get all team members
// @route   GET /api/team
export const getTeam = async (req, res) => {
  try {
    const teamMembers = await Team.find();
    res.status(200).json({
      success: true,
      count: teamMembers.length,
      data: teamMembers
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};

// @desc    Get single team member
// @route   GET /api/team/:id
export const getTeamMemberById = async (req, res) => {
  try {
    const { id } = req.params;
    let member;
    if (id.match(/^[0-9a-fA-F]{24}$/)) {
      member = await Team.findById(id);
    } else {
      member = await Team.findOne({ name: { $regex: new RegExp(id, 'i') } });
    }

    if (!member) {
      return res.status(404).json({ success: false, message: 'Team member not found' });
    }

    res.status(200).json({ success: true, data: member });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
