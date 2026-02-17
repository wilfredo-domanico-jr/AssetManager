<?php

namespace App\Http\Controllers\Api;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssetsController extends Controller
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
        ]);
    }
}
