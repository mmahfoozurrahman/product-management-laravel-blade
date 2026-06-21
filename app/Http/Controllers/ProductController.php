<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product list.
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Display the given product.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    /**
     * Return the product list as JSON.
     */
    public function json(): JsonResponse
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Product list retrieved successfully.',
            'data' => $products,
        ]);
    }

    /**
     * Redirect to the product list.
     */
    public function redirectToIndex(): RedirectResponse
    {
        return redirect()
            ->route('products.index')
            ->with('status', 'You have been redirected to the product list.');
    }

    /**
     * Sample summary data for the module home page.
     *
     * This stays lightweight now and can be expanded in Step 5 when form
     * handling and product creation are added.
     */
    public function summary(): View
    {
        $categoryCount = Category::count();
        $productCount = Product::count();
        $latestProduct = Product::with('category')->latest()->first();

        return view('products.summary', compact('categoryCount', 'productCount', 'latestProduct'));
    }
}
