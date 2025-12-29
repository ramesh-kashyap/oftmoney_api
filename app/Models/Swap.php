<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    protected $fillable = [
        'user_id',
        'from_token',
        'to_token',
        'amount',
        'receive',
        'rate',
    ];
}