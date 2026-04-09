<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Specify the table name
    protected $table = 'departments';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'description',
    ];


    public function assets()
    {
        return $this->hasMany(Asset::class, 'id', 'department_id');
    }
}
