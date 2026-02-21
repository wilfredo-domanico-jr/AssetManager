<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

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

        $data = [
            'totalAssets' => $totalAssets,
            'deployedAssets' => $deployedAssets,
            'inStockAssets' => $inStockAssets,
            'criticalAsset' => $criticalAsset,
            'recentAssets' => $recentAssets,
            'assetByCategory' => $assetByCategory
        ];

        return response()->json($data, 200);
    }
}
