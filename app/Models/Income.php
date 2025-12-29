<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes'; // Table name

    protected $fillable = [
        'id',
        'user_id_fk',
        'amt',       // your table has 'amt' column too
        'amount',
        'remarks',
        'ttime',
        'level',
        'rname',
        'fullname',
        'invest_id',
        'credit_type',
    ];
}
