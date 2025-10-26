<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'asset_name',
        'category',
        'department',
        'purchase_date',
        'purchase_cost',
        'useful_life',
        'supplier',
        'condition',
        'image',
        'description',
    ];
}
