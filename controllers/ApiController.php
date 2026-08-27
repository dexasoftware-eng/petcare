<?php

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Models\Product;
use Models\Service;
use Models\Pet;
use Models\User;
use Models\Order;

class ApiController extends Controller
{
    public function health(): void
    {
        $this->json([
            'status' => 'healthy',
            'framework' => 'PetGuard PHP MVC Engine',
            'php_version' => PHP_VERSION,
            'timestamp' => date('c')
        ]);
    }

    public function stats(): void
    {
        $this->json([
            'success' => true,
            'data' => [
                'totalUsers' => User::count(),
                'totalPets' => Pet::count(),
                'totalOrders' => Order::count(),
                'roleBreakdown' => [
                    'petowner' => User::count("role = 'petowner'"),
                    'veterinarian' => User::count("role = 'veterinarian'"),
                    'shelter' => User::count("role = 'shelter'"),
                    'admin' => User::count("role = 'admin'")
                ]
            ]
        ]);
    }

    public function products(): void
    {
        $products = Product::where('in_stock = 1', [], 'id DESC', 20);
        $this->json(['success' => true, 'data' => $products]);
    }

    public function services(): void
    {
        $services = Service::all('id ASC');
        $this->json(['success' => true, 'data' => $services]);
    }

    public function pets(): void
    {
        if (!Auth::check()) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $pets = Pet::getPetsByUser(Auth::id());
        $this->json(['success' => true, 'data' => $pets]);
    }
}
