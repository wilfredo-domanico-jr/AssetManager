<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepreciationSummaryCsvExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $purchaseCost = $asset->purchase_cost ?? 0;
        $usefulLife = $asset->useful_life ?? 1;

        $purchaseDate = $asset->purchase_date
            ? Carbon::parse($asset->purchase_date)
            : null;

        $monthsUsed = $purchaseDate
            ? $purchaseDate->diffInMonths(Carbon::now())
            : 0;

        $yearsUsed = $monthsUsed / 12;

        $depreciationPerYear = $purchaseCost / $usefulLife;

        $accumulatedDep = min($depreciationPerYear * $yearsUsed, $purchaseCost);

        $bookValue = max($purchaseCost - $accumulatedDep, 0);

        $depreciationRate = $purchaseCost > 0
            ? ($accumulatedDep / $purchaseCost) * 100
            : 0;

        $status  =  $yearsUsed < $usefulLife;

        $isActive = "Active";

        if (!$status) {
            $isActive = "Fully Depreciated";
        }


        return [
            $asset->asset_name ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $isActive,
            number_format($purchaseCost, 2),
            number_format($accumulatedDep, 2),
            number_format($bookValue, 2),
            number_format($depreciationRate, 2) . '%',
        ];
    }
}
