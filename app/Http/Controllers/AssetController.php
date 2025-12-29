<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssetController extends Controller
{

    public function myPackages(Request $request)
    {
         $userId = $request->user()->id;

        $packages = DB::table('investments')
            ->where('user_id', $userId)
            ->where('status', 'Active')
            ->pluck('plan'); // plan = package name OR id

        return response()->json([
            'packages' => $packages
        ]);
    }


    public function balance(Request $request)
    {
       
         $userId = $request->user()->id;
         $user = \App\Models\TelegramUser::find($userId);

        return response()->json([
            'usdt' => (float) $user->usdt_balance,
            'oft'  => (float) $user->balance,
        ]);
    }

       public function index(Request $request)
    {
                /* ---------------- BALANCES ---------------- */

         $userId = $request->user()->id;
         $user = \App\Models\TelegramUser::find($userId);
         $usdtBalance = (float) $user->usdt_balance;

        $oftBalance = (float) $user->balance;
        /* ---------------- INCOME CARDS ---------------- */

        $totalPackage = DB::table('investments')
            ->where('user_id', $userId)
            ->where('status', 'Active')
            ->sum('amount');

        $dailyRoi = DB::table('incomes')
            ->where('user_id', $userId)
            ->where('remarks', 'Daily ROI')
            ->sum('amount');

        $referralIncome = DB::table('incomes')
            ->where('user_id', $userId)
            ->where('remarks', 'Referral Income')
            ->sum('amount');

        $levelIncome = DB::table('incomes')
            ->where('user_id', $userId)
            ->where('remarks', 'Level Income')
            ->sum('amount');

        $salaryIncome = DB::table('incomes')
            ->where('user_id', $userId)
            ->where('remarks', 'Salary Income')
            ->sum('amount');

        $rewardIncome = DB::table('incomes')
            ->where('user_id', $userId)
            ->where('remarks', 'Reward Income')
            ->sum('amount');

        $total_withdrawal = DB::table('withdraws')
            ->where('user_id', $userId)
            ->sum('amount');

        $totalEarned = $dailyRoi + $referralIncome + $levelIncome + $salaryIncome + $rewardIncome;

        /* ---------------- RECENT HISTORY (LIMIT 6) ---------------- */

    
        return response()->json([
            'balances' => [
                'USDT' => (float) $usdtBalance,
                'OFT'  => (float) $oftBalance,
            ],
            'income_cards' => [
                'totalPackage' => $totalPackage,
                'daily_roi' => $dailyRoi,
                'referral_income' => $referralIncome,
                'level_income' => $levelIncome,
                'salary_income' => $salaryIncome,
                'reward_income' => $rewardIncome,
                'total_earned' => $totalEarned,
                'total_withdrawal' => $total_withdrawal,
            ],
        ]);
    }



     public function buy(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
        ]);

        $userId = $request->user()->id;
         $user = \App\Models\TelegramUser::find($userId);

        // Define packages (same as frontend)
        $packages = [
            1 => ['name' => 'Starter', 'price' => 25, 'daily' => 0.2, 'month' => 1],
            2 => ['name' => 'Basic', 'price' => 50, 'daily' => 0.3, 'month' => 1],
            3 => ['name' => 'Standard', 'price' => 100, 'daily' => 0.4, 'month' => 1],
            4 => ['name' => 'Advanced', 'price' => 200, 'daily' => 0.4, 'month' => 1],
            5 => ['name' => 'Pro', 'price' => 500, 'daily' => 0.5, 'month' => 1],
            6 => ['name' => 'Elite', 'price' => 1000, 'daily' => 0.6, 'month' => 1],
            7 => ['name' => 'VIP', 'price' => 2500, 'daily' => 0.7, 'month' => 1],
        ];

        if (!isset($packages[$request->package_id])) {
            return response()->json(['message' => 'Invalid package'], 422);
        }

        $pkg = $packages[$request->package_id];


            // ❌ already purchased?
            $exists = DB::table('investments')
                ->where('user_id', $user->id)
                ->where('plan', $pkg['name'])
                ->where('status', 'Active')
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Package already purchased'
                ], 422);
            }

        if ($user->usdt_balance < $pkg['price']) {
            return response()->json([
                'message' => 'Insufficient USDT balance'
            ], 422);
        }

        DB::transaction(function () use ($user, $pkg) {

            // Deduct USDT
            $user->usdt_balance -= $pkg['price'];
            $user->package += $pkg['price'];
            $user->active_status = 'Active';
            $user->save();

             $oftPrice = DB::table('general_settings')
            ->where('id', 1)
            ->value('oft_price');
            // Insert package
            DB::table('investments')->insert([
                'plan'          => $pkg['name'],
                'user_id'       => $user->id,
                'user_id_fk'       => $user->telegram_id,
                'amount'        => $pkg['price'],
                'token'         => $pkg['price']/$oftPrice,
                'sdate'         => Carbon::now()->toDateString(),
                'status'        => 'Active',
                'walletType'    => 1,
                'daily_roi'     => $pkg['daily'],
                'roiCondition'  => 0,
                'payment_mode'  => 'USDT',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

               // 🔹 Referral Income
        if (!empty($user->referred_by)) {
            // Find sponsor by telegram_id OR user_id
            $sponsor = DB::table('telegram_users')
                ->where('telegram_id', $user->referred_by)->first();

            if ($sponsor) {
                $referralPercent = 15; // 🔧 configurable
                $referralIncome = ($pkg['price'] * $referralPercent) / 100;
                $refferalToken = $referralIncome / $oftPrice;

                if ($sponsor->active_status == 'Active') 
                    {
                  // ➕ Add balance
                    DB::table('telegram_users')
                    ->where('id', $sponsor->id)
                    ->increment('balance', $refferalToken);
                      // 🧾 Store income
                     DB::table('incomes')->insert([
                    'user_id'    => $sponsor->id,
                    'user_id_fk'   => $sponsor->telegram_id,
                    'amt'     => $referralIncome,
                    'amount'     => $refferalToken,
                    'remarks'    => 'Referral Income',
                    'rname'     => $user->telegram_id,
                    'ttime' => now(),
                    'fullname' => $user->first_name . ' ' . $user->last_name,
                    'created_at' => now(),
                ]);
                  }    
             
            }
        }

        });

        return response()->json([
            'message' => 'Package purchased successfully'
        ]);
    }



    public function withdraw(Request $request)
{
    $request->validate([
        'network' => 'required|in:BSC,TRON',
        'address' => 'required|min:10',
        'amount'  => 'required|numeric|min:5',
    ]);

     $userId = $request->user()->id;
     $user = \App\Models\TelegramUser::find($userId);

    if ($request->amount > $user->usdt_balance) {
        return response()->json([
            'message' => 'Insufficient balance'
        ], 422);
    }

    $fee = $request->amount * 0.10;
    $net = $request->amount - $fee;

    // Deduct balance
    $user->usdt_balance -= $request->amount;
    $user->save();

    // Store withdrawal
    DB::table('withdraws')->insert([
        'user_id'     => $user->id,
        'user_id_fk'     => $user->telegram_id,
        'payment_mode'     => $request->network,
        'account'     => $request->address,
        'amount'      => $request->amount,
        'fee'         => $fee,
        'net_amount'  => $net,
        'status'      => 'Pending',
        'wdate'  => now(),
        'created_at'  => now(),
    ]);

    return response()->json([
        'message' => 'Withdrawal request submitted',
        'net_amount' => $net,
    ]);
}




}