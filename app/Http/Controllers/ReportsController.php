<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $assets = Asset::all();
        // 1️⃣ Total Purchase Cost
        $totalPurchaseCost = Asset::sum('purchase_cost');

        // 2️⃣ Total Book Value (based on depreciation)
        $totalBookValue = $assets->sum(function ($asset) {
            $purchaseCost = $asset->purchase_cost ?? 0;
            $usefulLife = $asset->useful_life ?? 1; // prevent divide by zero

            // Parse the purchase date safely
            $purchaseDate = $asset->purchase_date ? Carbon::parse($asset->purchase_date) : null;

            // Ensure monthsUsed is always positive
            $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(Carbon::now()) : 0;

            // Convert to years (decimal)
            $yearsUsed = $monthsUsed / 12;

            // Straight-line depreciation
            $depreciationPerYear = $purchaseCost / $usefulLife;
            $bookValue = max($purchaseCost - ($depreciationPerYear * $yearsUsed), 0);

            return $bookValue;
        });

        // 3️⃣ Total Depreciation
        $totalDepreciation = $totalPurchaseCost - $totalBookValue;

        $assets = Asset::with('category', 'department')->paginate(3);
        $data = [
            'totalPurchaseCost' => $totalPurchaseCost,
            'totalBookValue' => $totalBookValue,
            'totalDepreciation' => $totalDepreciation,
            'assets' => $assets
        ];
        return view('reporting.depreciation', $data);
    }

    public function inventory()
    {

        $assets = Asset::with('category', 'department')->paginate(3);


        $data = [
            'assets' => $assets
        ];

        return view('reporting.inventory', $data);
    }

    public function lifecycle()
    {
        return view('reporting.lifecycle');
    }
}
