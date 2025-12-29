@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow" style="padding-top: 10px; margin-top: 10px;">
    <h2 class="text-2xl font-semibold mb-4" style="margin-left: 10px;margin-top: 10px">
        Fund Report
    </h2>
       <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Basic Borderless Example</h4>
                                        <p class="text-muted font-14">
                                            Add <code>.table-borderless</code> for a table without borders.
                                        </p>

                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="basic-borderless-preview">
                                                <div class="table-responsive-sm">
                                                    <table class="table table-centered table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>UserName</th>
                                                                <th>User Id</th>
                                                                <th>Amount</th>
                                                                <th>Transection Id</th>
                                                                <th>Bdate</th>
                                                                <th>Type</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             @forelse($fundReport as $report)
                                                            <tr>
                                                                <td>{{ $report->user_id_fk }}</td>
                                                                <td>{{ $report->user_id }}</td>
                                                                <td>{{ $report->amount }}</td>
                                                                <td>{{ $report->txn_no }}</td>
                                                                <td>{{ $report->bdate }}</td>
                                                                <td>{{ $report->type}}</td>
                                                                <td>
                                                                    <!-- Switch-->
                                                                    <div>
            <input 
                type="checkbox"
                id="switch{{ $report->id }}"
                data-id="{{ $report->id }}"
                class="statusToggle"
                {{ $report->status == 'Approved' ? 'checked' : '' }}
                data-switch="success">

            <label for="switch{{ $report->id }}" 
                   data-on-label="Approved" 
                   data-off-label="Pending" 
                   class="mb-0 d-block">
            </label>
        </div>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Pending Users Found</td>
                                                            </tr>
                                                        @endforelse
                                                        {{ $fundReport->links() }}
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->                     
                                            </div> <!-- end preview-->
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
    
</div>
<script>
    document.querySelectorAll('.statusToggle').forEach(function(toggle){

        toggle.addEventListener('change', function(){

            let id = this.getAttribute('data-id');
            let status = this.checked ? 'Approved' : 'Pending';

            fetch("{{ route('fund-statusUpdate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: id,
                    status: status
                })
            });
        });
    });
</script>
@endsection