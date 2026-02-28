<?php

namespace App\Exports;

use App\Models\Asset;
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
            'REMAINING LIFE'
        ];
    }


    public function map($asset): array
    {

        $yearsUsedText = $asset->years_used;
        $yearsLabel = $asset->years_used <= 1 ? 'year' : 'years';

        $usefulLifeText = $asset->useful_life;
        $usefulLifeLabel = $asset->useful_life <= 1 ? 'year' : 'years';

        $remaininglLifeText = $asset->years_remaining;
        $remainingLifeLabel = $asset->years_remaining <= 1 ? 'year' : 'years';

        return [
            $asset->asset_name ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $asset->life_cycle_status,
            $asset->condition,
            number_format($yearsUsedText, 1) . " $yearsLabel",
            number_format($usefulLifeText, 1) . "$usefulLifeLabel",
            number_format($remaininglLifeText, 1) . "$remainingLifeLabel"
        ];
    }
}
