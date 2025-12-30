<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TelegramUser;
use App\Models\Investment;
use App\Models\Income;
use App\Models\Withdraw;
use App\Models\Buyfund;

class IncomeController extends Controller
{
public function roiIncome()
{
    $roiIncomes = Income::where('remarks', 'ROI Income')
        ->orderBy('id')
        ->paginate(10); // 👈 pagination

    return view('income.roi-income', compact('roiIncomes'));
}


  public function depositReport(Request $request)
{
    // default pagination limit
    $limit = $request->input('limit', 10);

    $query = Investment::query(); // your table model name

    // search filter
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function($q) use ($search){
            $q->where('user_id_fk', 'like', "%$search%")
              ->orWhere('plan', 'like', "%$search%")
              ->orWhere('token', 'like', "%$search%")
              ->orWhere('amount', 'like', "%$search%");
        });
    }

    // paginate and keep search+limit
    $depositReport = $query
        ->orderBy('id','DESC')
        ->paginate($limit)
        ->appends($request->all());

    return view('deposit-report', compact('depositReport'));
}



    public function addfundreport(){
     
        $fundReport = Buyfund::paginate(20);
        return view('fund-report', compact('fundReport'));
    }

     public function pendingWithdraw(Request $request)
{
    $query = Withdraw::where('status', 'Pending');

    // Search filter
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('user_id_fk', 'LIKE', "%$search%")
              ->orWhere('plan', 'LIKE', "%$search%")
              ->orWhere('payment_mode', 'LIKE', "%$search%");
        });
    }

    // Limit (default 10)
    $limit = $request->get('limit', 10);

    $withdrawReport = $query->paginate($limit)->appends($request->all());

    return view('wallet.pending-withdraw', compact('withdrawReport'));
}

    public function ApprovedWithdraw(Request $request)
{
    $query = Withdraw::where('status', 'Approved');

    // 🔍 Search filter
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('user_id_fk', 'LIKE', "%$search%")
              ->orWhere('plan', 'LIKE', "%$search%")
              ->orWhere('payment_mode', 'LIKE', "%$search%");
        });
    }

    // 📌 Limit dropdown (default 10)
    $limit = $request->get('limit', 10);

    // 📌 Pagination + keep query parameters
    $ApprovedReport = $query->paginate($limit)->appends($request->all());

    return view('wallet.approved-withdraw', compact('ApprovedReport'));
}

    public function FailedWithdraw(Request $request)
{
    $query = Withdraw::where('status', 'Failed');

    // 🔍 Search filter
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('user_id_fk', 'LIKE', "%$search%")
              ->orWhere('plan', 'LIKE', "%$search%")
              ->orWhere('payment_mode', 'LIKE', "%$search%");
        });
    }

    // 📌 limit dropdown (default 10)
    $limit = $request->get('limit', 10);

    // 📌 pagination with query string persistence
    $FailedReport = $query->paginate($limit)->appends($request->all());

    return view('wallet.failed-withdraw', compact('FailedReport'));
}

     public function addfund(){
        return view('wallet.add-fund');
    }
        public function buyFundsStore(Request $request)       
        {
            //  dd($request);
            $request->validate([
                'user_id' => 'required|numeric',
                'amount'  => 'required|numeric|min:1',
                // 'type'    => 'required|in:USDT,OFT',

            ]);

            // check user exists in TelegramUser table
            $user = TelegramUser::where('telegram_id', $request->user_id)->first();

            if (!$user) {
                return back()->withErrors(['user_id' => 'User not found in TelegramUser table']);
            }

            // Save record
            BuyFund::create([
                'user_id' => $user->id,
                'user_id_fk' => $user->telegram_id,
                'amount'  => $request->amount,
                'txn_no'  => 'TXN' . time(),   // generate transaction id
                'type' =>"USDT",
                'bdate' =>Date("Y-m-d"),
            ]);
            
                $user->increment('usdt_balance', $request->amount);
           
            return back()->with('success', 'Funds added successfully');
        }


     public function updateStatus(Request $request)
            {
                $report = Investment::findOrFail($request->id);

                $report->status = $request->status;   // Active / Pending
                $report->save();

                return response()->json(['success' => true]);
            }
     public function fundStatus(Request $request)
            {
                $report = Buyfund::findOrFail($request->id);

                $report->status = $request->status;   // Active / Pending
                $report->save();

                return response()->json(['success' => true]);
            }       


   public function levelIncome()
    {
        $levelIncomes = Income::where('remarks', 'Level Income')
            ->orderBy('id')
            ->paginate(10);
            

        return view('income.level-income', compact('levelIncomes'));
    }
     
     public function fundreport()
    {
        $levelIncomes = Income::where('remarks', 'Level Income')->orderByDesc('id')
            ->get();

        return view('income.level-income', compact('levelIncomes'));
    }

 public function dailyReferralIncome()
    {
        // Fetch only Direct Referral Income rows
        $dailyReferralIncomes = Income::where('remarks', 'Referral Income')
            ->orderBy('id')
            ->paginate(10);

        return view('income.daily-referral-income', compact('dailyReferralIncomes'));
    }




 public function pendingDeposit()
    {
        return view('pending_deposite'); 
        // resources/views/pending_deposite.blade.php
    }


 public function rejectDeposit()
    {
        return view('reject_deposite'); 
        // resources/views/reject_deposite.blade.php
    }




 public function approveDeposit()
    {
        return view('approval_deposite'); 
        // resources/views/approval_deposite.blade.php
    }

    

    public function pendingWithdrawal()
        {
            return view('pending_withdrawal'); 
            // resources/views/pending_withdrawal.blade.php
        }


     public function rejectWithdrawal()
        {
            return view('reject_withdrawal'); 
            // resources/views/reject_withdrawal.blade.php
        } 

     public function approvalWithdrawal()
          {
                return view('approval_withdrawal'); 
                // resources/views/approval_withdrawal.blade.php
          }












}
