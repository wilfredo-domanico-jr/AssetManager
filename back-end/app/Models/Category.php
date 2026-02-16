<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Specify the table name
    protected $table = 'categories';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'description',
    ];


    public function assets()
    {
        return $this->hasMany(Asset::class, 'id', 'category_id');
    }
}
