<?php

namespace Controllers;

use Core\Controller;
use Helpers\Flash;
use Models\Blog;
use Models\BlogComment;

class BlogController extends Controller
{
    public function index(): void
    {
        $page = (int)$this->request->get('page', 1);
        $blogsData = Blog::paginate($page, 6, '1=1', [], 'id DESC');
        $recentBlogs = Blog::getRecent(3);

        $this->render('blog.index', [
            'pageTitle' => 'Veterinary Insights & Articles — PetGuard',
            'blogs' => $blogsData['items'],
            'pagination' => $blogsData['pagination'],
            'recentBlogs' => $recentBlogs
        ]);
    }

    public function details(string $slug): void
    {
        $blog = Blog::findBySlug($slug);

        if (!$blog) {
            $this->redirect('our-blog');
        }

        // Increment views
        Blog::execute("UPDATE `blogs` SET views = views + 1 WHERE id = :id", ['id' => $blog['id']]);

        $recentBlogs = Blog::where('id != :id', ['id' => $blog['id']], 'id DESC', 3);

        $this->render('blog.details', [
            'pageTitle' => "{$blog['title']} — PetGuard",
            'blog' => $blog,
            'recentBlogs' => $recentBlogs
        ]);
    }

    public function addComment(string $slug): void
    {
        $blog = Blog::findBySlug($slug);
        if (!$blog) {
            $this->redirect('our-blog');
        }

        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'text' => 'required|min:3'
        ]);

        BlogComment::create([
            'blog_id' => $blog['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'text' => $data['text'],
            'avatar' => 'assets/img/comment-1.jpg'
        ]);

        Flash::success('Your comment has been published.');
        $this->redirect("blog/{$slug}");
    }
}
