<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $categoryCount = Category::count();
        $productCount = Product::count();
        $totalStockQuantity = Product::sum('stock');
        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'categoryCount',
            'productCount',
            'totalStockQuantity',
            'latestProducts'
        ));
    }
}
