<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventorySummaryExcelExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $purchaseDate = $asset->purchase_date ? Carbon::parse($asset->purchase_date) : null;

        return [
            $asset->asset_name ?? 'N/A',
            $asset->supplier ?? 'N/A',
            $asset->category?->name ?? 'N/A',
            $asset->department?->name ?? 'N/A',
            $purchaseDate ? $purchaseDate->format('Y-m-d') : 'N/A',
            number_format($purchaseCost, 2),
            number_format($asset->book_value, 2),
            $asset->condition ?? 'N/A',
        ];
    }
}
