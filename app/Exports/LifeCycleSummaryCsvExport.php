<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LifeCycleSummaryCsvExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            'CONDITION',
            'AGE',
            'USEFUL LIFE',
            'REMAINING LIFE',
            'RECOMENDATION'
        ];
    }


    public function map($asset): array
    {

        $usefulLife = $asset->useful_life ?? 1; // in years

        // Parse purchase date safely
        $purchaseDate = $asset->purchase_date
            ? \Carbon\Carbon::parse($asset->purchase_date)
            : null;

        // Age in years (decimal)
        $yearsUsed = $purchaseDate
            ? $purchaseDate->diffInMonths(\Carbon\Carbon::now()) / 12
            : 0;

        // Remaining life
        $remainingLife = max($usefulLife - $yearsUsed, 0);


        $status = $yearsUsed < $usefulLife;

        $isActive = "Active";

        if (!$status) {
            $isActive = "Fully Depreciated";
        }



        return [
            $asset->asset_name ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $isActive,
            $asset->condition,
            number_format($yearsUsed, 1) . " yrs",
            number_format($usefulLife, 1) . " yrs",
            number_format($remainingLife, 1) . " yrs",
            "Recommendation"

        ];
    }
}
