<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\Task;
use App\Models\DailyTask;
use App\Models\Investment;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function login(Request $request)
    {
      
            $validation =  Validator::make($request->all(), [
                'email' => 'required|unique:users',
                'password' => 'required|string',

            ]);
        
            // dd($request);
            $post_array  = $request->all();
            $credentials = $request->only('email', 'password');
                 
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

    

                return redirect()->route('dashboard');
            }
            else
            {
                // echo "credentials are invalid"; die;
                return Redirect::back()->withErrors(array('Invalid Username & Password !'));
            }
        
        }




    public function dashboard()
    {
    //    dd(Auth::check());
        $userCount = TelegramUser::whereNotNull('telegram_id')->count();
        $activeUser = TelegramUser::where('active_status', 'Active')->count();
        $pendingUser = TelegramUser::where('active_status', 'Pending')->count();
        $todaysRegistrations = TelegramUser::whereDate('created_at', Carbon::today())->count();
        $pendingDeposit = Investment::whereDate('created_at', Carbon::today())->where('status', 'Pending')->sum('amount');
        // dd($activeUser);
        $taskCount = Task::count();
        $Roiincome = Income::where('remarks', 'Roi Income')->sum('amt');
        $Directincome = Income::where('remarks', 'Direct Income')->sum('amt');
        // dd($Roiincome);
        $dailyTaskCount = DailyTask::count();
        // dd($userCount);
        return view('dashboard', compact('userCount','pendingUser','todaysRegistrations','activeUser', 'taskCount', 'dailyTaskCount','pendingDeposit','Roiincome','Directincome'));
    }
    // public function income()
    // {
    //     $Roiincome = Income::where('remarks','Roi Income');
    //     return view('dashboard', compact('Roiincome'));
    // }
    public function activeuser(){
         $activeUsers = TelegramUser::where('active_status' ,'Active')->paginate(10);
        return view('active_user', compact('activeUsers'));
    }
    public function pendinguser(){
         $pendingUsers = TelegramUser::where('active_status' ,'Pending')->paginate(10);
        return view('pending-user', compact('pendingUsers'));
    }

     public function totaluser(){
         $totalUsers = TelegramUser::paginate(10);
        //  dd($totalUsers);
        return view('total-user', compact('totalUsers'));
    }
   


    public function users()
    {
        $users = TelegramUser::all();
        return view('users', compact('users'));
    }

    public function tasks()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function createTask()
    {
        return view('create_task');
    }

    public function storeTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'reward_coins' => 'required|integer|min:1',
        ]);

        Task::create($validated);

        return redirect()->route('tasks')->with('success', 'Task created successfully');
    }

    public function dailyTasks()
    {
        $dailyTasks = DailyTask::all();
        return view('daily_tasks', compact('dailyTasks'));
    }

    public function createDailyTask()
    {
        return view('create_daily_task');
    }

    public function storeDailyTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_login_streak' => 'required|integer|min:1|max:10',
            'reward_coins' => 'required|integer|min:1',
        ]);

        DailyTask::create($validated);

        return redirect()->route('daily_tasks')->with('success', 'Daily task created successfully');
    }

    public function editTask(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_taps' => 'required|integer|min:0',
            'reward_coins' => 'required|integer|min:1',
        ]);

        $task->update($validated);

        return redirect()->route('tasks')->with('success', 'Task updated successfully');
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks')->with('success', 'Task deleted successfully');
    }

    public function editDailyTask(DailyTask $dailyTask)
    {
        return view('daily_tasks.edit', compact('dailyTask'));
    }

    public function updateDailyTask(Request $request, DailyTask $dailyTask)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_login_streak' => 'required|integer|min:1|max:10',
            'reward_coins' => 'required|integer|min:1',
        ]);

        $dailyTask->update($validated);

        return redirect()->route('daily_tasks')->with('success', 'Daily task updated successfully');
    }

    public function deleteDailyTask(DailyTask $dailyTask)
    {
        $dailyTask->delete();
        return redirect()->route('daily_tasks')->with('success', 'Daily task deleted successfully');
    }
}