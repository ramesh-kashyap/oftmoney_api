

	@include('layouts.app')
 <div class="content-body">



    <div class="content-body" style="min-height: 732px;">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Add Address</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
     
     
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Daily Create Task</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.store_daily_task') }}" method="POST">
                                     <input type="hidden" name="_token" value="Ha0oVXbK7jE2IoPlpSqYXSG6QRI0yH1wJ2Vlg9SB">
                                        <div class="row">
                                       

                                            <div class="mb-3 col-md-12">
                                                <label class="form-label"> Name</label>                                             
                                                <input type="text" placeholder="Enter Name" name="name" value="" class="form-control" required="" id="">
                                            </div>
                                            
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>                                             
                                                <textarea type="file" name="description" class="form-control" rows="4" required="">
                                                </textarea>
                                                </div>


                                                
                                            <div class="mb-3 col-md-12">


                                                <label class="form-label">Login Streak</label>                                             
                                                <input type="text" placeholder="Enter login streak " name="required_login_streak" value="" min="1" max="10" class="form-control" required="">
                                            </div>
                                            
                                            <div class="mb-3 col-md-12">


                                                <label class="form-label">Reward Coins</label>                                             
                                                <input type="text" placeholder="Enter coins " name="reward_coins" value="" class="form-control" required="">
                                            </div>
                                            
                                            
                                             
                                         
                                           
                                        </div>
     
                                      
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                
     
     
     
     
                </div>
            </div>
        </div>
 </div>


</div>



	@include('layouts.footer')