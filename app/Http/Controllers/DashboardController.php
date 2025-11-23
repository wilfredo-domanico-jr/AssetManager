<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        // Bilangin lahat ng asset na nacreate.
        $totalAssets = Asset::count();
        $deployedAssets = Asset::whereIsDeployed(true)->count();

        $inStockAssets = $totalAssets - $deployedAssets;

        $criticalAsset = Asset::whereNotNull('purchase_date')
            ->whereNotNull('useful_life')
            ->whereRaw("DATE_ADD(purchase_date, INTERVAL useful_life YEAR) <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)")
            ->count();


        // Get the top 3 recent assets

        $recentAssets = Asset::with('category')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Group assets by condition and count
        $assetByCondition = Asset::select('condition', DB::raw('COUNT(*) as total'))
            ->groupBy('condition')
            ->orderByDesc('total')
            ->get();


        // Get the condition with the highest count
        $highestCondition = $assetByCondition->first();


        // Group assets by category and count
        $assetByCategory = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('COUNT(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        $highestByCategory = $assetByCategory->first();

        // I-compile dito yung data
        $data = [
            'totalAssets' => $totalAssets,
            'deployedAssets' => $deployedAssets,
            'inStockAssets' => $inStockAssets,
            'criticalAsset' => $criticalAsset,
            'recentAssets' => $recentAssets,
            'highestCondition' => $highestCondition,
            'highestByCategory' => $highestByCategory
        ];

        // dd($data);
        return view('dashboard', $data);
    }
}
