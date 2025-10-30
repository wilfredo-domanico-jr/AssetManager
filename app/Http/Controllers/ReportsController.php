<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use Illuminate\Http\Request;

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


        $data = [
            'totalPurchaseCost' => $totalPurchaseCost,
            'totalBookValue' => $totalBookValue,
            'totalDepreciation' => $totalDepreciation
        ];
        return view('reports.depreciation',$data);
    }

    public function inventory()
    {
         return view('reports.inventory');
    }

     public function lifecycle()
    {
         return view('reports.lifecycle');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
