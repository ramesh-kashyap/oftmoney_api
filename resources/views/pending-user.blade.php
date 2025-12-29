@include('layouts.app')
<div class="content-body">
<div class="container-fluid">
				
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">User Management</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Pending Users</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pending Users</h4>
                            </div>
                            <div class="card-body">
                                
                                    <form action="pending-user" method="GET">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" style="height: 3rem;" placeholder="Search Users" name="search" class="form-control" value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group mb-3">
                                                    <select name="limit" style="height: 3rem;" class="form-control">
                                                        @foreach([10,25,50,100] as $val)
                                                        <option value="{{ $val }}" {{ request('limit',10)==$val?'selected':'' }}>
                                                        {{ $val }}
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
                                                    <a href="{{asset('')}}admin/pending-user" style="padding: 0.6rem 2rem;" name="reset" class="btn btn-outline-theme btn-lg d-block w-100 btn-primary" value="Reset">Reset</a>
                                                </div>
                                            </div>
        
        
                                        </div>
                                    </form>
                                    
                                <div class="table-responsive">
                                    <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                        
                                        <div id="example_filter" class="dataTables_filter"><label>Search:<input
                                                    type="search" class="" placeholder=""
                                                    aria-controls="example"></label></div>
                                        <table id="example" class="display dataTable no-footer" style="min-width: 845px"
                                            role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="S NO.: activate to sort column descending"
                                                        style="width: 60.9583px;">S NO.</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="User Name: activate to sort column ascending"
                                                        style="width: 108.417px;">User Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="User Id: activate to sort column ascending"
                                                        style="width: 83.125px;">User Id</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Email ID: activate to sort column ascending"
                                                        style="width: 255.792px;">Email ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Joining Date: activate to sort column ascending"
                                                        style="width: 163.365px;">Joining Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Status: activate to sort column ascending"
                                                        style="width: 72.2188px;">Status</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                                                
                                                                                                                                        
                                                                                            
                                                                                            
                                                                                            
                                                      @php
                                                                $i = ($pendingUsers->currentPage() - 1) * $pendingUsers->perPage();
                                                            @endphp                                       
                                                   @forelse($pendingUsers as $user)            
                                                 <tr class="odd" role="row">
                                                    <td class="sorting_1">{{ ++$i }}</td>
                                                    <td>{{ $user->first_name }}</td>
                                                    <td>{{ $user->telegram_id }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <!-- <td>1234567890</td> -->
                                                    <td>{{ $user->created_at }}</td>
                                                    <!-- <td>2024-06-27 07:55:10</td> -->
                                                    <td><span class="badge bg-danger">{{ $user->active_status }}</span>
                                                    </td>
                    
                                                </tr>
                                                  @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Pending Users Found</td>
                                                            </tr>
                                                        @endforelse
                                            </tbody>
                                       
                                    </table>
                                 
                                   
                                    </div>
                                    
                                     
                                      <br>

                                    <nav>
                                <ul class="pagination">
            
                            <!-- <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li> -->
            
            
                            
                
                {{ $pendingUsers->links() }}
                                                                        
            
                            <!-- <li class="page-item">
                    <a class="page-link" href="" rel="next" aria-label="Next »">›</a>
                </li> -->
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