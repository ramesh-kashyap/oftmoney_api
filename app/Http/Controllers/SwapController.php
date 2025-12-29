<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Swap;

class SwapController extends Controller
{
    public function info(Request $request)
    {
        $userId = $request->user()->id;
        $user = \App\Models\TelegramUser::find($userId);
        $oftPrice = DB::table('general_settings')
            ->where('id', 1)
            ->value('oft_price');

        return response()->json([
            'balances' => [
                'USDT' => (float) $user->usdt_balance,
                'OFT'  => (float) $user->balance,
            ],
            'price' => [
                'OFT_USDT' => (float) $oftPrice,     // 1 OFT = x USDT
                'USDT_OFT' => $oftPrice > 0 ? (1 / $oftPrice) : 0,
            ],
        ]);
    }

  
public function submit(Request $request)
{
    $request->validate([
        'from'   => 'required|in:OFT,USDT',
        'to'     => 'required|in:OFT,USDT',
        'amount' => 'required|numeric|min:0.0001',
    ]);

   $userId = $request->user()->id;
   $user = \App\Models\TelegramUser::find($userId);

    // Get price from general_settings
    $price = DB::table('general_settings')
        ->where('id', 1)
        ->value('oft_price');

    if (!$price || $price <= 0) {
        return response()->json(['message' => 'Price not configured'], 422);
    }

    DB::beginTransaction();

    try {
        if ($request->from === 'OFT') {
            $receive = $request->amount * $price;

            if ($user->balance < $request->amount) {
                return response()->json(['message' => 'Insufficient OFT balance'], 422);
            }

            $user->balance -= $request->amount;
            $user->usdt_balance += $receive;
            $rate = $price;

        } else {
            $receive = $request->amount / $price;

            if ($user->usdt_balance < $request->amount) {
                return response()->json(['message' => 'Insufficient USDT balance'], 422);
            }

            $user->usdt_balance -= $request->amount;
            $user->balance += $receive;
            $rate = 1 / $price;
        }

        $user->save();

        // ✅ INSERT SWAP HISTORY
        Swap::create([
            'user_id'    => $user->id,
            'from_token' => $request->from,
            'to_token'   => $request->to,
            'amount'     => $request->amount,
            'receive'    => $receive,
            'rate'       => $rate,
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Swap successful',
            'receive' => round($receive, 6),
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'message' => 'Swap failed',
        ], 500);
    }
}


public function history(Request $request)
{
      $userId = $request->user()->id;
   $user = \App\Models\TelegramUser::find($userId);

    $swaps = \DB::table('swaps')
        ->where('user_id', $user->id)
        ->orderByDesc('id')
        ->limit(10)
        ->get()
        ->map(function ($row) {
            return [
                'id' => $row->id,
                'type' => "{$row->from_token} → {$row->to_token}",
                'amount' => $row->amount,
                'receive' => $row->receive,
                'from_token' => $row->from_token,
                'to_token' => $row->to_token,
                'created_at' => $row->created_at,
            ];
        });

    return response()->json([
        'data' => $swaps,
    ]);
}

}