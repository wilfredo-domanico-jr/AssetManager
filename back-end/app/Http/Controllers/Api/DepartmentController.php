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



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create($request->only('name', 'description'));

        return response()->json([
            'message' => 'Department added successfully!'
        ], 201);
    }

    public function edit(Department $department)
    {
        return response()->json(['department' => $department], 200);
    }


    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department->update($request->only('name', 'description'));


        return response()->json([
            'message' => 'Department updated successfully!',
            'department' => $department
        ], 200);
    }



    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'message' => 'Department deleted successfully!'
        ]);
    }
}
