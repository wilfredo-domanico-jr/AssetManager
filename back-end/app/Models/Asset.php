<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';
    protected $appends = ['book_value', 'years_used', 'years_remaining', 'life_cycle_status', 'accumulated_depreciation', 'depreciation_rate', 'depreciation_status'];


    protected $casts = [
        'purchase_date' => 'date',
    ];

    protected $fillable = [
        'asset_name',
        'category_id',
        'department_id',
        'purchase_date',
        'purchase_cost',
        'useful_life',
        'supplier',
        'condition',
        'image',
        'description',
        'is_deployed',
        'deployed_name',
        'deployed_designation'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }


    public function getBookValueAttribute()
    {
        $purchaseCost = $this->purchase_cost ?? 0;
        $accumulatedDep = $this->accumulated_depreciation;
        $bookValue = max($purchaseCost - $accumulatedDep, 0);
        return $bookValue;
    }


    public function getYearsUsedAttribute()
    {
        if (!$this->purchase_date) {
            return 0;
        }


        $monthsUsed = $this->purchase_date->diffInMonths(now());

        $yearsUsed = $monthsUsed / 12;

        return floor($yearsUsed * 100) / 100;
    }

    public function getAccumulatedDepreciationAttribute()
    {
        $purchaseCost = $this->purchase_cost ?? 0;
        $usefulLife = $this->useful_life ?? 1; // in years

        // Parse purchase date safely
        $purchaseDate = $this->purchase_date
            ? \Carbon\Carbon::parse($this->purchase_date)
            : null;

        // Months and years used
        $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(\Carbon\Carbon::now()) : 0;
        $yearsUsed = $monthsUsed / 12;

        // Straight-line depreciation
        $depreciationPerYear = $purchaseCost / $usefulLife;
        $accumulatedDep = min($depreciationPerYear * $yearsUsed, $purchaseCost);

        return $accumulatedDep;
    }


    public function getDepreciationRateAttribute()
    {
        $purchaseCost = $this->purchase_cost ?? 0;
        $accumulatedDep = $this->accumulated_depreciation;
        $depreciationRate = $purchaseCost > 0 ? ($accumulatedDep / $purchaseCost) * 100 : 0;
        return $depreciationRate;
    }

    public function getDepreciationStatusAttribute()
    {
        return $this->years_used < $this->useful_life ?? 1 ? 'Active' : 'Fully Depreciated';
    }

    public function getYearsRemainingAttribute()
    {
        return max($this->useful_life ?? 1 - $this->years_used, 0);;
    }

    public function getLifeCycleStatusAttribute()
    {

        $usefulLife = $this->useful_life > 0 ? $this->useful_life : 1;

        $yearsRemaining = $this->years_remaining ?? 0;

        if ($yearsRemaining <= 0) {
            $status = "Fully Depreciated";
        } elseif ($yearsRemaining / $usefulLife <= 0.2) { // < 20% remaining
            $status = "Near End";
        } else {
            $status = "Good";
        }

        return $status;
    }
}
