import mongoose from 'mongoose';

const productSchema = new mongoose.Schema({
  name: {
    type: String,
    required: [true, 'Product name is required'],
    trim: true
  },
  slug: {
    type: String,
    required: true,
    unique: true,
    lowercase: true
  },
  category: {
    type: String,
    required: [true, 'Product category is required']
  },
  price: {
    type: Number,
    required: [true, 'Product price is required'],
    min: 0
  },
  oldPrice: {
    type: Number,
    default: null
  },
  rating: {
    type: Number,
    default: 5,
    min: 1,
    max: 5
  },
  discount: {
    type: String,
    default: null
  },
  img: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  sku: {
    type: String,
    required: true,
    unique: true
  },
  inStock: {
    type: Boolean,
    default: true
  },
  isDealOfWeek: {
    type: Boolean,
    default: false
  },
  reviewsCount: {
    type: Number,
    default: 28
  }
}, {
  timestamps: true
});

export const Product = mongoose.model('Product', productSchema);
