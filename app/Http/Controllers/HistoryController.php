<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $perPage = $request->get('per_page', 10);

        $history = DB::query()->fromSub(function ($query) use ($userId) {

            // BUY FUNDS (Deposits)
            $query->select(
                'id',
                'amount',
                DB::raw("'Deposits' as type"),
                DB::raw("'USDT' as token"),
                'created_at'
            )
            ->from('buy_funds')
            ->where('user_id', $userId)

            ->unionAll(

                // INCOMES
                DB::table('incomes')
                    ->select(
                        'id',
                        'amount',
                        'remarks as type',
                        DB::raw("'OFT' as token"),
                        'created_at'
                    )
                    ->where('user_id', $userId)
            )

            ->unionAll(

                // WITHDRAWS
                DB::table('withdraws')
                    ->select(
                        'id',
                        'amount',
                        DB::raw("'Withdrawal' as type"),
                        DB::raw("'USDT' as token"),
                        'created_at'
                    )
                    ->where('user_id', $userId)
            )

            ->unionAll(

                // INVESTMENTS
                DB::table('investments')
                    ->select(
                        'id',
                        'amount',
                        DB::raw("'Buy Package' as type"),
                        DB::raw("'USDT' as token"),
                        'created_at'
                    )
                    ->where('user_id', $userId)
            );

        }, 'history')
        ->orderByDesc('created_at')
        ->paginate($perPage);

        return response()->json($history);
    }
}