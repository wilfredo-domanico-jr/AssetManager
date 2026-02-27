<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventorySummaryCsvExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Asset::with('category', 'department')->get();
    }


    public function headings(): array
    {
        return [
            'ASSET NAME',
            'SUPPLIER',
            'CATEGORY',
            'DEPARTMENT',
            'PURCHASE DATE',
            'ORIGINAL COST',
            'CURRENT VALUE',
            'CONDITION'
        ];
    }

    public function map($asset): array
    {
        $purchaseCost = $asset->purchase_cost ?? 0;
        $usefulLife = $asset->useful_life ?? 1;
        $purchaseDate = $asset->purchase_date ? Carbon::parse($asset->purchase_date) : null;

        $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(Carbon::now()) : 0;
        $yearsUsed = $monthsUsed / 12;

        $depreciationPerYear = $purchaseCost / $usefulLife;
        $bookValue = max($purchaseCost - ($depreciationPerYear * $yearsUsed), 0);

        return [
            $asset->asset_name ?? 'N/A',
            $asset->supplier ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $asset->department?->name ?? 'N/A',
            $purchaseDate ? $purchaseDate->format('Y-m-d') : 'N/A',
            number_format($purchaseCost, 2),
            number_format($bookValue, 2),
            $asset->condition ?? 'N/A',
        ];
    }
}
