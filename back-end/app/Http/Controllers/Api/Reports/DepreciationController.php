<?php

namespace App\Http\Controllers\Api\Reports;

use App\Models\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepreciationController extends Controller
{

    public function index(Request $request)
    {

        $assets = Asset::all();

        $totalPurchaseCost = Asset::sum('purchase_cost');

        $totalBookValue = $assets->sum(function ($asset) {
            $purchaseCost = $asset->purchase_cost ?? 0;
            $usefulLife = $asset->useful_life ?? 1; // prevent divide by zero

            // Parse the purchase date safely
            $purchaseDate = $asset->purchase_date ? Carbon::parse($asset->purchase_date) : null;

            // Ensure monthsUsed is always positive
            $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(Carbon::now()) : 0;

            // Convert to years (decimal)
            $yearsUsed = $monthsUsed / 12;


            $depreciationPerYear = $purchaseCost / $usefulLife;
            $bookValue = max($purchaseCost - ($depreciationPerYear * $yearsUsed), 0);

            return $bookValue;
        });


        $totalDepreciation = $totalPurchaseCost - $totalBookValue;

        $assets = Asset::with('category', 'department')->paginate(3);

        $data = [
            'totalPurchaseCost' => $totalPurchaseCost,
            'totalBookValue' => $totalBookValue,
            'totalDepreciation' => $totalDepreciation,
            'assets' => $assets
        ];


        return response()->json($data, 200);
    }
}
