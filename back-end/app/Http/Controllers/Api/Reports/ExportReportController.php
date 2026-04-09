<?php

namespace App\Http\Controllers\Api\Reports;

use App\Exports\DepreciationSummaryExcelExport;
use App\Exports\InventorySummaryExcelExport;
use App\Exports\LifeCycleSummaryExcelExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportController extends Controller
{

    public function exportDepreciation(Request $request)
    {

        return Excel::download(
            new DepreciationSummaryExcelExport(
                $request->search,
                $request->category,
                $request->department,
                $request->condition
            ),
            'depreciation-summary.xlsx'
        );
    }


    public function exportInventory(Request $request)
    {

        return Excel::download(
            new InventorySummaryExcelExport(
                $request->search,
                $request->category,
                $request->department,
                $request->condition
            ),
            'inventory-summary.xlsx'
        );
    }

    public function exportLifeCycle(Request $request)
    {

        return Excel::download(
            new LifeCycleSummaryExcelExport(
                $request->search,
                $request->category,
                $request->department,
                $request->condition
            ),
            'lifecycle-summary.xlsx'
        );
    }
}
