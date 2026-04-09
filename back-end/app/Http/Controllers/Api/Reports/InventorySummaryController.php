<?php

namespace App\Http\Controllers\Api\Reports;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventorySummaryController extends Controller
{

    public function index(Request $request)
    {

        $query = Asset::with(['category', 'department'])
            ->when($request->search, fn($q) => $q->where('asset_name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category_id', $request->category))
            ->when($request->department, fn($q) => $q->where('department_id', $request->department))
            ->when($request->condition, fn($q) => $q->where('condition', $request->condition))
            ->latest();


        $assets = (clone $query)->paginate(3);


        $categories = Category::all();
        $departments = Department::all();

        $data = [
            'categories' => $categories,
            'departments' => $departments,
            'assets' => $assets
        ];

        return response()->json($data, 200);
    }
}
