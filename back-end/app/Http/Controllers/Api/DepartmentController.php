<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        // Filter department
        $departments = Department::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->department, fn($q) => $q->where('description', $request->department))
            ->latest()
            ->paginate(3);

        return response()->json([
            'departments' => $departments
        ], 200);
    }



    // public function edit(Category $category)
    // {
    //     return response()->json(['category' => $category], 200);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     Category::create($request->only('name', 'description'));

    //     return response()->json([
    //         'message' => 'Category added successfully!'
    //     ], 201);
    // }



    // public function update(Request $request, Category $category)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     $category->update($request->only('name', 'description'));


    //     return response()->json([
    //         'message' => 'Category updated successfully!',
    //         'category' => $category
    //     ], 200);
    // }



    // public function destroy(Category $category)
    // {
    //     $category->delete();
    //     return response()->json([
    //         'message' => 'Category deleted successfully!'
    //     ]);
    // }
}
