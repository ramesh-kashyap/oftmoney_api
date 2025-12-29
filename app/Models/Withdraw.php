<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    //
    protected $table = 'withdraws';
    protected $fillable = [
        'user_id',
        'user_id_fk',
        'amount',
        'convert_amt',
        'status',
        'wdate',
        'txn_id',
        'payment_mode',
        'account',
        'paid_date',
        'wallet_type',
    ];
}
