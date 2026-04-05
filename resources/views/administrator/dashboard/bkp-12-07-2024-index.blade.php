@extends('administrator.layout.administrator')
@section('content')
<style>
	.tyu {
		width: 75px;
		border: 5px solid #4e204c;
		height: 70px;
		float: left;
	}

	.num {
		font-size: 25px;
		color: #7210a5;
	}

	@media screen and (max-width:767px) {
		.wrapper {
			background: #f0f4f5;
		}
	}
</style>
<div class="container-fluid pt-25">

	<!-- Row -->
	<div class="row">

		<!-- {{ Form::open(array('url' => URL::to('administrator/dashboard'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }} -->
		<form method="get">
			<div class="row">
				<div class="col-md-6">
					<?php 
				if(isset($_GET['select_date']))
				{
					$date = $_GET['select_date'];
				}else{
					$date = date('d-m-Y');
					
					// $ttttt = date('Y-m-d')
					// //$date = date('Y-m-d', strtotime($ttttt));
					// $date =$ttttt;
					//$date = '';
				}
				?>

					<input type="date" name="select_date" value="{{$date}}" class="form-control"
						placeholder="Select Date" id="cdate" required>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success">Search</button>
				</div>
				<div class="col-md-3">
					<a href="{{URL::to('/administrator/dashboard')}}" class="btn btn-success">Refresh Today</a>
				</div>
			</div>
			{{ Form::close() }}
			<br>
			<br>

			{{-- new --}}
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Customer
													Balance</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$customer_balance }}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Add Money</span>
												<span class="txt-light block counter">
													<span class="counter-anim">{{ $add_money }}</span>
												</span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Withdraw
													Money</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$withdraw_money }}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Today
													Deposit</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$today_deposit }}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>--}}

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Total
													Bidding</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$Total_bidding }}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">Commission</span>
												<span class="txt-light block counter"><span
														class="counter-anim">{{$total_commission}}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-13">Winning
													Amount</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$today_win }}</span></span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="javascript:void(null)">
											<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block">Profit</span>
												<span class="txt-light block counter">
													<span class="counter-anim">{{ $todaypl }}</span>
												</span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-money txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Disawar</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$Disawar}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $Disawar_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $Disawar_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-18">Laxmi Darbar</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{ $laxmidarbar }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $laxmidarbar_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $laxmidarbar_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Rajdhani Gold </span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{ $rajdhanigold }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $rajdhanigold_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $rajdhanigold_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">TAJ</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$TajBet}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $TajBet_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $TajBet_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-18">Delhi
													Bazar</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$DelhiBazar}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $DelhiBazar_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $DelhiBazar_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6  text-center pl-5 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-18">Shree
													Ganesh</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$ShreeGanesh}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $ShreeGanesh_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $ShreeGanesh_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Faridabad</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$Faridabad}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $Faridabad_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $Faridabad_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Matka Market</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$matkamarket}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $matkamarket_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $matkamarket_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Ghaziabad</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$GhaziaBad}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $GhaziaBad_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $GhaziaBad_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Avadh Express</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{ @$avadhexpress }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ @$avadhexpress_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ @$avadhexpress_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">Gali</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{$GaliBet}}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ $GaliBet_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ $GaliBet_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			

			{{-- close new --}}
			

			
			
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-18">KGF Time</span>
												<span class="weight-500 uppercase-font txt-light font-12">Bidding Rs.
													{{ @$kgftime }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Wining
													Rs. {{ @$kgftime_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-12">Total
													Bal . {{ @$kgftime_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">MORNING STAR </span>
												<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
													{{ @$morningstar }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Wining
													Rs. {{ @$morningstar_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Total
													Bal . {{ @$morningstar_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">LONDON BAZAAR </span>
												<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
													{{ @$londonbazaar }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Wining
													Rs. {{ @$londonbazaar_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Total
													Bal . {{ @$londonbazaar_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">DEV DARSHAN </span>
												<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
													{{ @$devdarshan }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Wining
													Rs. {{ @$devdarshan_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Total
													Bal . {{ @$devdarshan_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">NEPAL BORDER </span>
												<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
													{{ @$nepalborder }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Wining
													Rs. {{ @$nepalborder_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Total
													Bal . {{ @$nepalborder_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class="col-xs-6 text-center pl-5 pr-0 data-wrap-left">
												<span
													class="weight-500 uppercase-font txt-light block font-13">INDIA CLUB </span>
												<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
													{{ @$indiaclub }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Wining
													Rs. {{ @$indiaclub_winning }}</span>
												<span class="weight-500 uppercase-font txt-light block font-10">Total
													Bal . {{ @$indiaclub_pl }} </span>
											</div>
											<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
												<i class="fa fa-users txt-light data-right-rep-icon"></i>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
	</div>

	<!-- Row -->
</div>
@endsection
@push('scripts')

<script>
	var total = $('#jodi').val();
	var bahar = $('#bahar').val();
	var andar = $('#andar').val();
	$('#joditotal').html("Rs." + total);
	$('#bahartotal').html("Rs." + bahar);
	$('#andartotal').html("Rs." + andar);
</script>

<script>
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = year + "-" + month + "-" + day;

	document.getElementById("cdate").value = today;
</script>
@endpush