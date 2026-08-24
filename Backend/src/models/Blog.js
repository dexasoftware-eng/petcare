import mongoose from 'mongoose';

const commentSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true
  },
  email: {
    type: String,
    default: ''
  },
  text: {
    type: String,
    required: true
  },
  avatar: {
    type: String,
    default: '/assets/img/comment-1.jpg'
  },
  createdAt: {
    type: Date,
    default: Date.now
  }
});

const blogSchema = new mongoose.Schema({
  title: {
    type: String,
    required: [true, 'Blog title is required'],
    trim: true
  },
  slug: {
    type: String,
    required: true,
    unique: true
  },
  category: {
    type: String,
    required: true
  },
  date: {
    day: { type: String, default: '23' },
    monthYear: { type: String, default: 'May,2023' }
  },
  author: {
    type: String,
    default: 'Willimes Domson'
  },
  authorImg: {
    type: String,
    default: '/assets/img/man.jpg'
  },
  img: {
    type: String,
    required: true
  },
  excerpt: {
    type: String,
    required: true
  },
  content: {
    type: String,
    required: true
  },
  comments: [commentSchema]
}, {
  timestamps: true
});

export const Blog = mongoose.model('Blog', blogSchema);
