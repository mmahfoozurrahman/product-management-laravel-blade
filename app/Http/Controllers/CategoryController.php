<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->withCount('products')
            ->latest()
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the create category form.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $category = Category::create($validated);

        return redirect()
            ->route('categories.confirmation', $category)
            ->with('status', 'Category created successfully.');
    }

    /**
     * Show the category confirmation page.
     */
    public function confirmation(Category $category): View
    {
        return view('categories.confirmation', compact('category'));
    }

    /**
     * Show the edit category form.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the given category.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.show', $category)
            ->with('status', 'Category updated successfully.');
    }

    /**
     * Display the given category.
     */
    public function show(Category $category): View
    {
        $category->load(['products' => function ($query) {
            $query->latest();
        }]);

        return view('categories.show', compact('category'));
    }

    /**
     * Remove the given category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('status', 'Category deleted successfully.');
    }
}
