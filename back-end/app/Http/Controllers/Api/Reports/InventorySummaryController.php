<?php

namespace App\Http\Controllers\Api\Reports;

use App\Models\Asset;
use App\Http\Controllers\Controller;

class InventorySummaryController extends Controller
{

    public function index()
    {

        $assets = Asset::with('category', 'department')->paginate(3);

        $data = [
            'assets' => $assets
        ];

        return response()->json($data, 200);
    }
}
