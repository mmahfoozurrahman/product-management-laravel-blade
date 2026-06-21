<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Build the base query for products with category names.
     */
    private function productQuery(): Builder
    {
        return DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.category_id',
                'products.name',
                'products.price',
                'products.stock',
                'categories.name as category_name'
            );
    }

    /**
     * Display the product list.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $sort = $request->query('sort', 'latest');

        $productsQuery = $this->productQuery();

        if ($search !== '') {
            $productsQuery->where('products.name', 'like', '%' . $search . '%');
        }

        match ($sort) {
            'price_asc' => $productsQuery->orderBy('products.price', 'asc'),
            'price_desc' => $productsQuery->orderBy('products.price', 'desc'),
            default => $productsQuery->orderByDesc('products.id'),
        };

        $products = $productsQuery->get();

        $productCount = DB::table('products')->count();

        return view('products.index', compact('products', 'productCount', 'search', 'sort'));
    }

    /**
     * Display the given product.
     */
    public function show(int $product): View
    {
        $product = $this->productQuery()
            ->where('products.id', $product)
            ->first();

        abort_if($product === null, 404);

        return view('products.show', compact('product'));
    }

    /**
     * Return the product list as JSON.
     */
    public function json(): JsonResponse
    {
        $products = $this->productQuery()
            ->orderByDesc('products.id')
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
        $categoryCount = DB::table('categories')->count();
        $productCount = DB::table('products')->count();
        $latestProduct = $this->productQuery()
            ->orderByDesc('products.id')
            ->first();

        return view('products.summary', compact('categoryCount', 'productCount', 'latestProduct'));
    }

    /**
     * Show the create product form.
     */
    public function create(): View
    {
        $categories = DB::table('categories')
            ->select('id', 'name')
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

        $category = DB::table('categories')
            ->select('id', 'name')
            ->where('id', $validated['category_id'])
            ->first();

        $productId = DB::table('products')->insertGetId([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product = $this->productQuery()
            ->where('products.id', $productId)
            ->first();

        Log::info(
            'product id: ' . $product->id
            . ', category: ' . ($category->name ?? 'Unknown')
            . ', name: ' . $product->name
            . ', price: ' . $product->price
            . ', stock: ' . $product->stock
        );

        return redirect()
            ->route('products.confirmation', $product->id)
            ->with('status', 'Product created successfully.');
    }

    /**
     * Show the product confirmation page.
     */
    public function confirmation(int $product): View
    {
        $product = $this->productQuery()
            ->where('products.id', $product)
            ->first();

        abort_if($product === null, 404);

        return view('products.confirmation', compact('product'));
    }

    /**
     * Show the edit product form.
     */
    public function edit(int $product): View
    {
        $product = $this->productQuery()
            ->where('products.id', $product)
            ->first();

        abort_if($product === null, 404);

        $categories = DB::table('categories')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the given product.
     */
    public function update(Request $request, int $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        abort_unless(DB::table('products')->where('id', $product)->exists(), 404);

        DB::table('products')
            ->where('id', $product)
            ->update([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Product updated successfully.');
    }

    /**
     * Delete the given product.
     */
    public function destroy(int $product): RedirectResponse
    {
        $deleted = DB::table('products')
            ->where('id', $product)
            ->delete();

        abort_if($deleted === 0, 404);

        return redirect()
            ->route('products.index')
            ->with('status', 'Product deleted successfully.');
    }
}
