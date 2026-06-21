<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    /**
     * Show the create product form.
     */
    public function create(): View
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::create($validated);
        $product->load('category');

        Log::info(
            'product id: ' . $product->id
            . ', category: ' . $product->category->name
            . ', name: ' . $product->name
            . ', price: ' . $product->price
            . ', stock: ' . $product->stock
        );

        return redirect()
            ->route('products.confirmation', $product)
            ->with('status', 'Product created successfully.');
    }

    /**
     * Show the product confirmation page.
     */
    public function confirmation(Product $product): View
    {
        $product->load('category');

        return view('products.confirmation', compact('product'));
    }
}
