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

    

                return redirect()->route('admin.dashboard');
            }
            else
            {
                // echo "credentials are invalid"; die;
                return Redirect::back()->withErrors(array('Invalid Username & Password !'));
            }
        
        }



public function logout(Request $request)
{
    Auth::logout();                          // logout user
    $request->session()->invalidate();       // invalidate session
    $request->session()->regenerateToken();  // regenerate CSRF token

    return redirect()->route('login')->with('success', 'Logged out successfully');
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
    public function activeuser(Request $request)
{
    // 1) read search and limit
    $search = $request->input('search');
    $limit  = $request->input('limit', 10);   // default 10

    // 2) base query
    $query = TelegramUser::where('active_status', 'Active');

    // 3) apply search (user name, email, id etc.)
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('telegram_id', 'LIKE', "%{$search}%");
        });
    }

    // 4) paginate with selected limit
    $activeUsers = $query->paginate($limit);

    // 5) keep search + limit in pagination links
    $activeUsers->appends([
        'search' => $search,
        'limit' => $limit,
    ]);

    return view('active_user', compact('activeUsers', 'search', 'limit'));
}

    public function pendinguser(Request $request)
{
    // Get limit (default 10)
    $limit = $request->input('limit', 10);

    // Base query
    $query = TelegramUser::where('active_status', 'Pending');

    // Search filter if search box filled
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('telegram_id', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
        });
    }

    // Pagination
    $pendingUsers = $query->paginate($limit)->appends($request->all());

    return view('pending-user', compact('pendingUsers'));
}


     public function totaluser(Request $request)
        {
            // Get search and limit
            $search = $request->input('search');
            $limit  = $request->input('limit', 10); // default 10

            // Base query
            $query = TelegramUser::query();

            // Apply search filter (name, email, id, sponsor, etc.)
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('telegram_id', 'LIKE', "%{$search}%")
                    ->orWhere('referred_by', 'LIKE', "%{$search}%");
                });
            }

            // Paginate using selected limit
            $totalUsers = $query->paginate($limit);

            // Preserve query string
            $totalUsers->appends([
                'search' => $search,
                'limit'  => $limit,
            ]);

            return view('total-user', compact('totalUsers', 'search', 'limit'));
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



public function logout(Request $request)
 {
    Auth::logout();                          // logout user
    $request->session()->invalidate();       // invalidate session
    $request->session()->regenerateToken();  // regenerate CSRF token

    return redirect()->route('login')->with('success', 'Logged out successfully');
 }
}