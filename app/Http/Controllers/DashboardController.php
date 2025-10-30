<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class DashboardController extends Controller
{
    public function index()
    {
       
        // Bilangin lahat ng asset na nacreate.
        $totalAssets = Asset::count();
        
        // Get the top 3 recent assets

        $recentAssets = Asset::with('category')
                     ->orderBy('created_at', 'desc')
                     ->take(3)
                     ->get();

        // I-compile dito yung data
        $data = [
            'totalAssets' => $totalAssets,
            'recentAssets' => $recentAssets
        ];
        
        // dd($data);
        return view('dashboard', $data);
    }


}
