<?php

namespace App\Http\Controllers\Api;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{

    public function index(Request $request)
    {

        // Fetch categories and departments
        $categories = Category::all();
        $departments = Department::all();

        // Filter assets
        $assets = Asset::with(['category', 'department'])
            ->when($request->search, fn($q) => $q->where('asset_name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category_id', $request->category))
            ->when($request->department, fn($q) => $q->where('department_id', $request->department))
            ->when($request->condition, fn($q) => $q->where('condition', $request->condition))
            ->latest()
            ->paginate(3);


        $totalAssets = Asset::count();
        $deployedAssets = Asset::whereIsDeployed(true)->count();
        $inStockAssets = $totalAssets - $deployedAssets;

        $criticalAsset = Asset::whereNotNull('purchase_date')
            ->whereNotNull('useful_life')
            ->whereRaw("DATE_ADD(purchase_date, INTERVAL useful_life YEAR) <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)")
            ->count();

        $recentAssets = Asset::with('category')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $assetByCategory = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('COUNT(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();


        return response()->json([
            'categories' => $categories,
            'departments' => $departments,
            'assets' => $assets,
            'statistics' => [
                'totalAssets' => $totalAssets,
                'deployedAssets' => $deployedAssets,
                'inStockAssets' => $inStockAssets,
                'criticalAsset' => $criticalAsset,
                'recentAssets' => $recentAssets,
                'assetByCategory' => $assetByCategory
            ]
        ], 200);
    }


    public function create()
    {
        $categories = Category::all();
        $departments = Department::all();

        return response()->json([
            'categories' => $categories,
            'departments' => $departments
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_name' => 'required|string|max:255|unique:assets,asset_name',
            'model' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'department_id' => 'required|integer|exists:departments,id',
            'purchase_date' => 'required|date',
            'purchase_cost' => 'required|numeric',
            'useful_life' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        Asset::create($validated);

        return response()->json([
            'message' => 'Asset added successfully!'
        ], 201);
    }


    public function edit(Asset $asset)
    {
        // Add full URL for the image if it exists
        $asset->image = $asset->image
            ? asset('storage/' . $asset->image)
            : null;

        return response()->json([
            'asset' => $asset,
            'categories' => Category::all(),
            'departments' => Department::all(),
        ], 200);
    }

    public function update(Request $request, Asset $asset)
    {

        $validated = $request->validate([
            'asset_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('assets', 'asset_name')->ignore($asset->id)
            ],
            'model' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'department_id' => 'required|integer|exists:departments,id',
            'purchase_date' => 'required|date',
            'purchase_cost' => 'required|numeric',
            'useful_life' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_deployed' => 'required|boolean',
            'deployed_name' => 'exclude_if:is_deployed,false|required|string|max:255',
            'deployed_designation' => 'exclude_if:is_deployed,false|required|integer|exists:departments,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $asset->is_deployed = $request->boolean('is_deployed');

        if ($asset->is_deployed) {
            $asset->deployed_name = $request->deployed_name;
            $asset->deployed_designation = $request->deployed_designation;
        } else {
            // Clear fields when not deployed
            $asset->deployed_name = null;
            $asset->deployed_designation = null;
        }


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($validated);

        return response()->json([
            'message' => 'Asset updated successfully!',
            'asset' => $asset
        ], 200);
    }


    public function destroy(Asset $asset)
    {
        if ($asset->image) {
            \Storage::disk('public')->delete($asset->image);
        }

        $asset->delete();

        return response()->json([
            'message' => 'Asset deleted successfully!'
        ]);
    }
}
