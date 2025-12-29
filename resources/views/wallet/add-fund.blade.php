	@include('layouts.app')
<div class="content-body" style="min-height: 732px;">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Buy Funds</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Add Funds</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
     
     
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Funds</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="add-funds-store" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                       

                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Iteam Name</label>                                             
                                                <input type="text" name="user_id"  placeholder="Enter Telegram Id" name="gudie_name" value="" class="form-control" required="" id="">
                                            </div>
                                            
                                            
                                            <div class="mb-3 col-md-12">


                                                <label class="form-label">Price </label>                                             
                                                <input type="Number" placeholder="Enter amount " name="amount" value="" class="form-control" required="">
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
        	@include('layouts.footer')