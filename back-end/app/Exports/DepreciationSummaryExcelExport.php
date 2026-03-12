<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepreciationSummaryExcelExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Asset::with('category', 'department')->get();
    }


    public function headings(): array
    {
        return [
            'ASSET NAME',
            'CATEGORY',
            'STATUS',
            'PURCHASE COST',
            'ACCUMULATED DEP.',
            'BOOK VALUE',
            'DEP. RATE'
        ];
    }


    public function map($asset): array
    {
        $status  =  $asset->years_used < $asset->useful_life;
        $isActive = "Active";
        if (!$status) {
            $isActive = "Fully Depreciated";
        }

        return [
            $asset->asset_name ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $isActive,
            number_format($asset->purchase_cost ?? 0, 2),
            number_format($asset->accumulated_depreciation, 2),
            number_format($asset->book_value, 2),
            number_format($asset->depreciation_rate, 2) . '%',
        ];
    }
}
