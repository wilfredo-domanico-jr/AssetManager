<?php

namespace App\Http\Controllers\Api\Reports;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepreciationController extends Controller
{

    public function index(Request $request)
    {


        $query = Asset::with(['category', 'department'])
            ->when($request->search, fn($q) => $q->where('asset_name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category_id', $request->category))
            ->when($request->department, fn($q) => $q->where('department_id', $request->department))
            ->when($request->condition, fn($q) => $q->where('condition', $request->condition))
            ->latest();

        // For listing (paginated)
        $assets = (clone $query)->paginate(3);

        // For totals (all filtered)
        $allAssets = $query->get();

        $totalPurchaseCost = $allAssets->sum('purchase_cost');
        $totalBookValue = $allAssets->sum(function ($asset) {
            $purchaseCost = $asset->purchase_cost ?? 0;
            $usefulLife = $asset->useful_life ?? 1;
            $purchaseDate = $asset->purchase_date ? Carbon::parse($asset->purchase_date) : null;
            $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(Carbon::now()) : 0;
            $yearsUsed = $monthsUsed / 12;
            $depreciationPerYear = $purchaseCost / $usefulLife;
            return max($purchaseCost - ($depreciationPerYear * $yearsUsed), 0);
        });

        $totalDepreciation = $totalPurchaseCost - $totalBookValue;

        $categories = Category::all();
        $departments = Department::all();

        $data = [
            'categories' => $categories,
            'departments' => $departments,
            'totalPurchaseCost' => round($totalPurchaseCost, 2),
            'totalBookValue' => round($totalBookValue, 2),
            'totalDepreciation' => round($totalDepreciation, 2),
            'assets' => $assets
        ];


        return response()->json($data, 200);
    }
}
