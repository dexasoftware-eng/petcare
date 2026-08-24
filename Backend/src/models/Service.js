import mongoose from 'mongoose';

const serviceSchema = new mongoose.Schema({
  title: {
    type: String,
    required: [true, 'Service title is required'],
    trim: true
  },
  slug: {
    type: String,
    required: true,
    unique: true
  },
  icon: {
    type: String,
    required: true
  },
  accentColor: {
    type: String,
    default: '#940c69'
  },
  shortDesc: {
    type: String,
    required: true
  },
  fullDesc: {
    type: String,
    required: true
  },
  features: [{
    type: String
  }],
  price: {
    type: String,
    default: '$45.00 / session'
  },
  isHighlight: {
    type: Boolean,
    default: false
  },
  bannerImg: {
    type: String,
    default: '/assets/img/we-provide-1.jpg'
  }
}, {
  timestamps: true
});

export const Service = mongoose.model('Service', serviceSchema);
