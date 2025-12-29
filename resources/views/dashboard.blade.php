
@include('layouts.app')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
					<h2 class="mb-3 me-auto">Dashboard</h2>
					<div>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						</ol>
					</div>
				</div>	
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">User</span>
											<h2>265</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
											<img src="{{asset('')}}admin/images/streamline.png" style="width: 80px;" alt="">
											
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Active User</span>
											<h2>6</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('')}}admin/images/streamline.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Pending User</span>
											<h2>259</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/streamline.png" style="    width: 61px;" alt="">

										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Telegram User</span>
											<h2>5
											</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/streamline.png" style="    width: 61px;" alt="">
							
										</div>
									</div>
								</div>
							</div> -->


							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Today Registration</span>
											<h2>0</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/streamline.png" style="    width: 61px;" alt="">
							
										</div>
									</div>
								</div>
							</div>



                            <div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Today Activated</span>
											<h2>0</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('')}}admin/images/investment.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Business</span>
											<h2>$  400.00 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
                                            
											
                                                <img src="{{asset('')}}admin/images/withdrawal.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							
							<!-- <div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total BuyFund</span>
											<h2>$  283.42 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
                                            
											
                                                <img src="{{asset('')}}admin/images/withdrawal.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Pending Deposit</span>
											<h2> 6.00 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
                                            
											
                                                <img src="{{asset('')}}admin/images/withdrawal.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Task Reward Income</span>
											<h2>$  0.00  </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('')}}admin/images/pool_comission.png" style="    width: 61px;" alt="">
									
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Node Reward Income</span>
											<h2>$ 5.92 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/medal.png" style="    width: 61px;" alt="">
									
										</div>
									</div>
								</div>
							</div>
                    	<div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Direct Income</span>
											<h2>$ 0.10 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/medal.png" style="    width: 61px;" alt="">
									
										</div>
									</div>
								</div>
							</div>



                         
                            <div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Pending Withdrawal</span>
											<h2>$ 0.00 </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('')}}admin/images/withdrawal.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>

                            <div class="col-xl-3 col-sm-3">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Approved Withdrawal</span>
											<h2>$ 66.00</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('')}}admin/images/withdrawal.png" style="    width: 61px;" alt="">
											
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

                 
					
				</div>
				
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
		@include('layouts.footer')