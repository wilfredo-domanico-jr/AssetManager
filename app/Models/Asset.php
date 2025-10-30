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
        'category_id',
        'department',
        'purchase_date',
        'purchase_cost',
        'useful_life',
        'supplier',
        'condition',
        'image',
        'description',
    ];


    public function category()
{
    return $this->belongsTo(Category::class, 'category_id','id');
}

}
