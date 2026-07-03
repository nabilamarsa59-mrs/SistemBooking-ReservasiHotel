<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyStat extends Model
{
    protected $table = 'monthly_stats';

    protected $fillable = [
        'month',
        'revenue',
        'visitors'
    ];
}