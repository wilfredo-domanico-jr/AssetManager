<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportEmail extends Model
{
    // Specify the table name
    protected $table = 'report_emails';

    // Allow mass assignment for these fields
    protected $fillable = [
        'email'
    ];
}
