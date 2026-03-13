<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepreciationSummaryExcelExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    protected $search;
    protected $category;
    protected $department;
    protected $condition;

    public function __construct($search, $category, $department, $condition)
    {
        $this->search = $search;
        $this->category = $category;
        $this->department = $department;
        $this->condition = $condition;
    }

    public function collection()
    {
        $query = Asset::with('category', 'department');

        if ($this->search) {
            $query->where('asset_name', 'like', '%' . $this->search . '%');
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        if ($this->condition) {
            $query->where('condition', $this->condition);
        }

        return $query->get();
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
