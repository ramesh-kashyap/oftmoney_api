
@include("layouts.app")

<div class="content-body">

<div class="container-fluid">
				
				{{-- <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Profit Summery </a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
					</ol>
                </div> --}}
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daily Tasks</h4>
                            </div>
                            <div class="card-body">
                                
                                 <form action="https://admin.aironetwork.in/admin/tasklist" method="GET">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" style="height: 3rem;" placeholder="Search Users" name="search" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group mb-3">
                                                    <select name="limit" style="height: 3rem;" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
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
                                                    <a href="https://admin.aironetwork.in/admin/tasklist" style="padding: 0.6rem 2rem;" name="reset" class="btn btn-outline-theme btn-lg d-block w-100 btn-primary" value="Reset">Reset</a>
                                                </div>
                                            </div>
        
        
                                        </div>
                                    </form>
                                    
                                <div class="table-responsive">
                                    <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="example"></label></div><table id="example" class="display dataTable no-footer" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S NO.: activate to sort column descending" style="width: 73.8333px;">S NO.</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Item Name: activate to sort column ascending" style="width: 171.25px;"> Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label=" Item Image  : activate to sort column ascending" style="width: 128.281px;"> Description</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 100.656px;">Login Streak</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Price : activate to sort column ascending" style="width: 67.8125px;">Reward Coins</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 100.656px;">Actions</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                                                                                            
                                                                                                    
                                              @forelse($dailyTasks as $daily)                                                      
                                                <tr class="odd" role="row">

                                                  <td class="sorting_1">{{$daily->id}}</td>
                                                      <td>{{$daily->name}}</td>
                                                                                                        
                                                      <td> {{$daily->description}} </td>
                                                      <td> {{$daily->required_login_streak}} </td>

                                                        <td> {{$daily->reward_coins}} </td>

                        <td class="table-action">
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="5">Delete</button>
                         </td>
                     </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No Tasks Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                                       
                                    </table><div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div><div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><span><a class="paginate_button current" aria-controls="example" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="example" data-dt-idx="2" tabindex="0" id="example_next"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div></div>
                                    
                                     <br>
                                     <nav>
        <ul class="pagination">
            
                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
            
            
                            
                
                
                                                                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=2">2</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=3">3</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=4">4</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=5">5</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=6">6</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=7">7</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=8">8</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=9">9</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=10">10</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=11">11</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=12">12</a></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=13">13</a></li>
                                                                        
            
                            <li class="page-item">
                    <a class="page-link" href="https://admin.aironetwork.in/admin/tasklist?limit=5&amp;page=2" rel="next" aria-label="Next »">›</a>
                </li>
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