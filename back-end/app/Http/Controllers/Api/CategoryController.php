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
}
