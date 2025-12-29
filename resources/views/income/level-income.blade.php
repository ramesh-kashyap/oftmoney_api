@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow" style="padding-top: 10px; margin-top: 10px;">
    <h2 class="text-2xl font-semibold mb-4" style="margin-left: 10px;margin-top: 10px">
        Level Income List
    </h2>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">User ID</th>
                    <th class="border px-4 py-2">User ID FK</th>
                    <th class="border px-4 py-2">Amount</th>
                    <th class="border px-4 py-2">Remarks</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Invest ID</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($levelIncomes as $income)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $income->id }}</td>
                        <td class="border px-4 py-2">{{ $income->user_id }}</td>
                        <td class="border px-4 py-2">{{ $income->user_id_fk }}</td>
                        <td class="border px-4 py-2">{{ number_format($income->amount, 2) }}</td>
                        <td class="border px-4 py-2">{{ $income->remarks }}</td>
                        <td class="border px-4 py-2">{{ $income->ttime }}</td>
                        <td class="border px-4 py-2">{{ $income->fullname }}</td>
                        <td class="border px-4 py-2">{{ $income->invest_id }}</td>
                        <td class="border px-4 py-2">
                            @if($income->credit_type == 0)
                                <span class="bg-blue-500 text-white px-2 py-1 rounded">
                                    Credited
                                </span>
                            @else
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded">
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-red-500 px-4 py-2">
                            No Level Income Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
