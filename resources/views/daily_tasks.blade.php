@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow" style="padding-top:10px; margin-top:10px;">
    
    <h2 class="text-2xl font-semibold mb-4" style="margin-left:10px;">
        Daily Task List
    </h2>

    {{-- <div class="mb-4" style="margin-left:10px;">
        <a href="{{ route('create_daily_task') }}"
           class="bg-blue-600 hover:bg-blue-700 text-bla px-4 py-2 rounded">
            Create New Daily Task
        </a>
    </div> --}}

    <div class="overflow-x-auto" style="margin:10px; padding:20px">
        <table class="min-w-full table-auto border-collapse border border-gray-300" style="padding:20px">
            <thead class="bg-gray-100">
                <tr class="text-center">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Login Streak</th>
                    <th class="border px-4 py-2">Reward Coins</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dailyTasks as $task)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $task->id }}</td>
                        <td class="border px-4 py-2">{{ $task->name }}</td>
                        <td class="border px-4 py-2">{{ $task->description }}</td>
                        <td class="border px-4 py-2">{{ $task->required_login_streak }}</td>
                        <td class="border px-4 py-2">
                            <span class="font-semibold">
                                {{ $task->reward_coins }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-red-500 px-4 py-3">
                            No Daily Tasks Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
