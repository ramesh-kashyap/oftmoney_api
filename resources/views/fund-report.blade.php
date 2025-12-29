	@include('layouts.app')
<div class="content-body" style="min-height: 732px;">
            <div class="container-fluid">
				
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Funds </a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Fund Report</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Fund Report</h4>
                            </div>
                            <div class="card-body">
                                       <form action="fund-report" method="GET">
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
                                                    <a href="{{asset('')}}admin/deposit-report" style="padding: 0.6rem 2rem;" name="reset" class="btn btn-outline-theme btn-lg d-block w-100 btn-primary" value="Reset">Reset</a>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="S NO.: activate to sort column descending"
                                                    style="width: 38.125px;">S NO.</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="User Name: activate to sort column ascending"
                                                    style="width: 73.1562px;">Telegram Id</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" aria-label="User Id: activate to sort column ascending"
                                                    style="width: 53.5833px;">Transection No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" aria-label="Amount: activate to sort column ascending"
                                                    style="width: 52.8854px;">Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Transaction Date.: activate to sort column ascending"
                                                    style="width: 116.708px;">Payment</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Transaction ID: activate to sort column ascending"
                                                    style="width: 162.094px;">Transaction Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Is Activation: activate to sort column ascending"
                                                    style="width: 82.7292px;">Status</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            @php
                                                                $i = ($fundReport->currentPage() - 1) * $fundReport->perPage();
                                                            @endphp                                       
                                                   @forelse($fundReport as $user)                 
                                                     <tr class="odd" role="row">
                                                      <td class="sorting_1">{{ ++$i }}</td>
                                                      <td>{{ $user->user_id_fk }}</td>
                                                      <td>{{ $user->txn_no }}</td>
                                                      <td>{{ $user->amount }}</td>
                                                      <td>{{ $user->type }}</td>
                                                      <td>{{ $user->bdate }}</td>              
                
                                                      <td><span>{{ $user->status }}</span></td>
                                                         
                                                  </tr>
                                                   @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Pending Users Found</td>
                                                            </tr>
                                                        @endforelse
                                                </tbody>
                                       
                                    </table>
                                      <br>

                                    <nav>
        <ul class="pagination">
            
                         {{ $fundReport->links() }}                                                                
            
                       
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