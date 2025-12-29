
@include('layouts.app')
<div class="content-body">
<div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">User Management</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Total Users</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Total Users</h4>
                    </div>
                    <div class="card-body">
                        
                                 <form action="total-user" method="GET">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" style="height: 3rem;" placeholder="Search Users" name="search" class="form-control" value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group mb-3">
                                                    <select name="limit" style="height: 3rem;" class="form-control">
                                                        @foreach([10,25,50,100] as $value)
                                                            <option value="{{ $value }}" {{ request('limit', 10) == $value ? 'selected' : '' }}>
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group mb-3">
                                                    <input type="submit" style="padding: 0.6rem 2rem;" name="submit" class="btn btn-outline-theme btn-lg d-block w-100 btn-primary" value="Search">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group mb-3">
                                                    <a href="{{asset('')}}admin/total-user" style="padding: 0.6rem 2rem;" name="reset" class="btn btn-outline-theme btn-lg d-block w-100 btn-primary" value="Reset">Reset</a>
                                                </div>
                                            </div>
        
        
                                        </div>
                                    </form>
                                    
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="example"></label></div><table id="example" class="display dataTable no-footer" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="S NO.: activate to sort column descending"
                                            style="width: 38.125px;">S NO.</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="User Name: activate to sort column ascending"
                                            style="width: 73.1562px;">User Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="User Id: activate to sort column ascending"
                                            style="width: 54.4896px;">User Id</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Email ID: activate to sort column ascending"
                                            style="width: 188.75px;">Email ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Password: activate to sort column ascending"
                                            style="width: 66.1458px;">Balance</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Txn Password: activate to sort column ascending"
                                            style="width: 94.9271px;">USDT Balance</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Joining Date: activate to sort column ascending"
                                            style="width: 84.0104px;">Joining Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Sponsor ID: activate to sort column ascending"
                                            style="width: 74.6771px;">Sponsor ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Package: activate to sort column ascending"
                                            style="width: 56.8229px;">Package</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Status: activate to sort column ascending"
                                            style="width: 55.0729px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                                                                                                
                                                                            
                                                                            
                                                                            
                                      @php
                                                                $i = ($totalUsers->currentPage() - 1) * $totalUsers->perPage();
                                                            @endphp                                        
                                     @forelse($totalUsers as $user)   
                                                                    <tr class="odd" role="row">
                                            <td class="sorting_1">{{ ++$i }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->telegram_id }}</td>
                                            <td>{{ $user->email }}</td>
                                             <!-- <td>India (भारत)</td> -->
                                            <!-- <td>91</td> -->
                                            <!-- <td>1234567890</td> -->
                                            <td>{{ $user->balance }}</td>
                                            <td>{{ $user->usdt_balance }}</td>
                               
                                            <td>{{ $user->created_at }}</td>

                                            <td> {{ $user->referred_by }}
                                            </td>
                                            <td>{{ $user->package}}</td>
                                            <td><span class="badge bg-success">{{ $user->status}}</span>
                                            </td>
                                             
                                            <!--<td><a href="/admin/profile-view/eyJpdiI6IjBmTGd1Z2ZmbHU1R1FlMnZBdHB3NGc9PSIsInZhbHVlIjoidlhaU09VMUxUV0UwOU12a1lVNkJUUT09IiwibWFjIjoiMDE1ZDhiZmI2YTUxNWEzYTIwZWQ5YzEzODQ3NDJkMmNiNDhmMWZjN2FkOTdiMTA3Yjk2MjYwYThmYTM5OTYxNyIsInRhZyI6IiJ9" class="badge green" style="background: green;">View Profile</a></td>-->
                                            
                <!--<td><a target="_blank" href="/admin/loginWithadmin?id=1" class="btn btn-success">Login ID</a></td> -->

                                        </tr>
                                         @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Pending Users Found</td>
                                                            </tr>
                                                        @endforelse
                      </tbody>

                            </table>
                            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a
                                    class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0"
                                    tabindex="0" id="example_previous"><i class="fa fa-angle-double-left"
                                        aria-hidden="true"></i></a><span><a class="paginate_button current"
                                        aria-controls="example" data-dt-idx="1" tabindex="0">1</a></span><a
                                    class="paginate_button next disabled" aria-controls="example" data-dt-idx="2"
                                    tabindex="0" id="example_next"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i></a></div>
                            </div>
                             <br>

                                    <nav>
        <ul class="pagination">
            
                            {{ $totalUsers->links() }}

                    
                    </ul>
    </nav>

                        </div>
                    </div>
                </div>
            </div>


        </div>
 </div>
 </div>
		@include('layouts.footer')