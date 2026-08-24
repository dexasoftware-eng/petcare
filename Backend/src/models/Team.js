import mongoose from 'mongoose';

const teamSchema = new mongoose.Schema({
  name: {
    type: String,
    required: [true, 'Staff member name is required']
  },
  role: {
    type: String,
    required: [true, 'Role is required']
  },
  img: {
    type: String,
    required: true
  },
  bio: {
    type: String,
    required: true
  },
  phone: {
    type: String,
    default: '+021 01283492'
  },
  email: {
    type: String,
    default: 'team@patte.com'
  },
  social: {
    facebook: { type: String, default: '#' },
    twitter: { type: String, default: '#' },
    instagram: { type: String, default: '#' }
  },
  skills: [{
    label: String,
    percentage: Number
  }]
}, {
  timestamps: true
});

export const Team = mongoose.model('Team', teamSchema);
