import express from 'express';
import { getBlogPosts, getBlogPostById, addBlogComment } from '../controllers/blogController.js';

const router = express.Router();
router.get('/', getBlogPosts);
router.get('/:id', getBlogPostById);
router.post('/:id/comments', addBlogComment);

export default router;
