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
        $assetByCategory = Asset::select('category_id', DB::raw('COUNT(*) as total'))
                        ->groupBy('category_id')
                        ->orderByDesc('total')
                        ->with('category') // eager load category details
                        ->get();

        $highestByCategory = $assetByCategory->first();
        
        // I-compile dito yung data
        $data = [
            'totalAssets' => $totalAssets,
            'recentAssets' => $recentAssets,
            'highestCondition' => $highestCondition,
            'highestByCategory' => $highestByCategory
        ];
        
        // dd($data);
        return view('dashboard', $data);
    }


}
