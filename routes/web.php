<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserTaskController;


/*
|--------------------------------------------------------------------------
| Public Routes (NO LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/**
 * Dashboard WITHOUT login
 */



 
  //   Route::post('/fund/status-update', [IncomeController::class, 'fundStatus'])->name('fund-statusUpdate');
/*
|--------------------------------------------------------------------------
| Protected Routes (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::get('/cryptapicallback', [ProfileController::class, 'edit'])->name('cryptapi.callback');
 Route::post('/loginAction', [AdminController::class, 'login'])->name('loginAction');

Route::middleware('auth') ->prefix('admin')->name('admin.')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', action: [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // Route::get('/tasks/create', [UserTaskController::class, 'createTask'])->name('create_task');
     Route::post('/tasks', [AdminController::class, 'storeTask'])->name('store.task');
 
    Route::get('/daily-tasks/create', [AdminController::class, 'createDailyTask'])->name('create_daily_task');
    Route::post('/daily-tasks', [AdminController::class, 'storeDailyTask'])->name('store_daily_task');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/roi/income', [IncomeController::class, 'roiIncome'])->name('roi.income');
    Route::get('/daily/referral/income', [IncomeController::class, 'dailyReferralIncome'])->name('daily.referral.income');
        
    Route::get('/level/income', [IncomeController::class, 'levelIncome']) ->name('level.income');

    Route::get('/active-user', [AdminController::class, 'activeuser'])->name('active.user');
    Route::get('/total-user', [AdminController::class, 'totaluser'])->name('total.user');


    Route::get('/pending-user', [AdminController::class, 'pendinguser'])->name('pending.user');

    Route::get('/pending-withdraw', [IncomeController::class, 'pendingWithdraw'])->name('pending-withdraw');
    
    

    Route::get('/deposit-report', [IncomeController::class,'depositReport'])->name('deposit-report');
    Route::post('/deposit/status-update', [IncomeController::class, 'updateStatus'])->name('deposit-statusUpdate');

    Route::get('/pending-withdraw', [IncomeController::class, 'pendingWithdraw'])->name('pending-withdraw');

    Route::get("/approved-deposit", [IncomeController::class, 'ApprovedDeposit'])->name('approved-deposit');

    Route::get('/approved-withdraw', [IncomeController::class, 'ApprovedWithdraw'])->name('approved-withdraw');
      Route::get('/failed-withdraw', [IncomeController::class, 'FailedWithdraw'])->name('failed-withdraw');
        Route::get('/add-funds', [IncomeController::class, 'addfund'])->name('add-funds');
    Route::get('/fund-report', [IncomeController::class, 'addfundreport'])->name('fund-report');
    Route::post('/fund/status-update', [IncomeController::class, 'fundStatus'])->name('fund-statusUpdate');
      Route::post('/add-funds-store', [IncomeController::class, 'buyFundsStore'])->name('admin.buy.funds');

      Route::get('/task/create', [UserTaskController::class, 'taskCreate'])->name('task_create');
      Route::get('/daily/create', [UserTaskController::class, 'dailyTask'])->name('daily_task_create');

    Route::get('/tasks', [AdminController::class, 'tasks'])->name('tasks');
    Route::get('/daily/tasks', [AdminController::class, 'dailyTasks'])->name('daily_tasks');
    Route::get('/change_password', [AdminC::class, 'changePassword'])->name('change_password');

  
    // Income
    
});

require __DIR__.'/auth.php';
