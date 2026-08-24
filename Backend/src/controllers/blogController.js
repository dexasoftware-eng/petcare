import { Blog } from '../models/Blog.js';

// @desc    Get all blog posts (with category and search filter)
// @route   GET /api/blog
export const getBlogPosts = async (req, res) => {
  try {
    const { category, search } = req.query;
    let query = {};

    if (category && category !== 'All') {
      query.category = { $regex: new RegExp(category, 'i') };
    }

    if (search) {
      query.$or = [
        { title: { $regex: search, $options: 'i' } },
        { content: { $regex: search, $options: 'i' } }
      ];
    }

    const posts = await Blog.find(query).sort({ createdAt: -1 });
    res.status(200).json({
      success: true,
      count: posts.length,
      data: posts
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};

// @desc    Get single blog post
// @route   GET /api/blog/:id
export const getBlogPostById = async (req, res) => {
  try {
    const { id } = req.params;
    let post;
    if (id.match(/^[0-9a-fA-F]{24}$/)) {
      post = await Blog.findById(id);
    } else {
      post = await Blog.findOne({ slug: id });
    }

    if (!post) {
      return res.status(404).json({ success: false, message: 'Article not found' });
    }

    res.status(200).json({ success: true, data: post });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};

// @desc    Add comment to blog post
// @route   POST /api/blog/:id/comments
export const addBlogComment = async (req, res) => {
  try {
    const { id } = req.params;
    const { name, email, text } = req.body;

    if (!name || !text) {
      return res.status(400).json({ success: false, message: 'Name and text are required' });
    }

    const post = await Blog.findById(id);
    if (!post) {
      return res.status(404).json({ success: false, message: 'Article not found' });
    }

    post.comments.push({
      name,
      email,
      text,
      avatar: '/assets/img/comment-1.jpg'
    });

    await post.save();

    res.status(201).json({
      success: true,
      message: 'Comment added successfully',
      data: post.comments
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error.message });
  }
};
