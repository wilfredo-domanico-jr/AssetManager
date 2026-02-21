<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        // Filter category
        $categories = Category::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('description', $request->category))
            ->latest()
            ->paginate(3);

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('name', 'description'));

        return response()->json([
            'message' => 'Category added successfully!'
        ], 201);
    }



    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully!'
        ]);
    }
}
