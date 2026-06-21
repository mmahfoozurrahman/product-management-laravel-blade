<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
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
}
