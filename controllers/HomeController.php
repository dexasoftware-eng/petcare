<?php

namespace Controllers;

use Core\Controller;
use Models\Category;
use Models\Product;
use Models\Service;
use Models\Blog;
use Models\Team;

class HomeController extends Controller
{
    public function index(): void
    {
        $categories = Category::all('id ASC');
        $featuredProducts = Product::getFeatured(6);
        $services = Service::all('is_highlight DESC, id ASC');
        $recentBlogs = Blog::getRecent(3);
        $team = Team::all('id ASC');

        $this->render('home.index', [
            'pageTitle' => 'PetGuard — Pet Care & Clinic',
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'services' => $services,
            'recentBlogs' => $recentBlogs,
            'team' => $team
        ]);
    }

    public function about(): void
    {
        $team = Team::all('id ASC');
        $this->render('pages.about', [
            'pageTitle' => 'About PetGuard — Our Mission & Clinic',
            'team' => $team
        ]);
    }

    public function howWeWork(): void
    {
        $this->render('pages.how-we-work', [
            'pageTitle' => 'How We Work — PetGuard',
        ]);
    }

    public function history(): void
    {
        $this->render('pages.history', [
            'pageTitle' => 'Our History & Heritage'
        ]);
    }

    public function pricing(): void
    {
        $this->render('pages.pricing', [
            'pageTitle' => 'Pricing Packages & Care Plans'
        ]);
    }

    public function gallery(): void
    {
        $this->render('pages.gallery', [
            'pageTitle' => 'Pet Photo Gallery & Community Highlights'
        ]);
    }
}
