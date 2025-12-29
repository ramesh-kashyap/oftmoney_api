<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    protected $table = 'investments';
    protected $fillable = [
        'id',
        'plan',
        'user_id_fk',
        'user_id',
        'amount',
        'sdate',
        'status',
        'transection_id',
        'slip',
        'payment_mode',
        'active_form',
        'roiCandition',
        'walletType',
        'month',
    ];
    public function user()
{
    return $this->belongsTo(TelegramUser::class, 'user_id', 'id');
}
}
