<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

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
}
