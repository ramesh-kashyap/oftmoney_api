<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyfund extends Model
{
    //
    protected $table ='buy_funds';
    protected $fillable = [
        'user_id',
        'user_id_fk',
        'amount',
        'txn_no',
        'bdate',
        'status',
        'slip',
        'type',
    ];
}
