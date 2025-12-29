@include('layouts.app')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow" style="padding-top: 10px; margin-top: 10px;">
    <h2 class="text-2xl font-semibold mb-4" style="margin-left: 10px;margin-top: 10px">
        active user
    </h2>
     <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Striped rows</h4>
                                        <p class="text-muted font-14">
                                            Use <code>.table-striped</code> to add zebra-striping to any table row
                                            within the <code>&lt;tbody&gt;</code>.
                                        </p>

                                        <!-- <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#striped-rows-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Preview
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#striped-rows-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Code
                                                </a>
                                            </li>
                                        </ul> -->
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="striped-rows-preview">
                                                <div class="table-responsive-sm">
                                                    <table class="table table-striped table-centered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                                <th>Telegram Id</th>
                                                                <th>Balance</th>
                                                                <th>Email</th>
                                                                <th>Status</th>
                                                                <th>Last Activity</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = ($activeUsers->currentPage() - 1) * $activeUsers->perPage();
                                                            @endphp
                                                            @forelse($activeUsers as $user)
                                                            <tr>
                                                                <td>{{ ++$i }}</td>
                                                                <td class="table-user">
                                                                    <!-- <img src="assets/images/users/avatar-2.jpg" alt="table-user" class="me-2 rounded-circle"> -->
                                                                   {{ $user->first_name }} {{ $user->last_name }}
                                                                </td>
                                                                <td>{{ $user->telegram_id }}</td>
                                                                <td> {{ $user->balance }}</td>
                                                                <td> {{ $user->email }}</td>
                                                                <td> {{ $user->status }}</td>
                                                                <td> {{ $user->last_tap_date }}</td>
                                                                <td class="table-action">
                                                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                                </td>
                                                            </tr>
                                                            @empty
    <tr>
        <td colspan="4" class="text-center">No Pending Users Found</td>
    </tr>
@endforelse
                                                        </tbody>
                                                        {{ $activeUsers->links() }}
                                                    </table>
                                                </div> <!-- end table-responsive-->                     
                                            </div> 
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>

    
</div>
	@include('layouts.footer')