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
	<div class="pt-25">

		<!-- Row -->
		<div class="row">
			<div class="col-md-12 mb3">
				<form method="get">
					<div class=" d-flex align-items-center mb-5">
						<div class="">
						
					<?php 
					if (isset($_GET['select_date'])) {
						$date = date('Y-m-d', strtotime($_GET['select_date']));
					} else {
						$date = date('Y-m-d'); // Use Y-m-d format
					}
					?>
					

							<input type="date" name="select_date" value="{{$date}}" class="form-control"
								placeholder="Select Date" id="cdate" required>
						</div>
						<div class="">
							<button class="btn btn-success m-0">Search</button>
						</div>
						<div class="">
							<a href="{{URL::to('/administrator/dashboard')}}" class="btn btn-success m-0">Refresh Today</a>
						</div>
					</div>
					{{ Form::close() }}

			</div>

			<!-- {{ Form::open(array('url' => URL::to('administrator/dashboard'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }} -->


			{{-- new --}}
			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Customer
										Balance</span>
									<span class="txt-light block counter"><span class="counter-anim">{{
		$customer_balance }}</span></span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Add Money</span>
									<span class="txt-light block counter">
										<span class="counter-anim">{{ $add_money }}</span>
									</span>
								</div>
								<div class="pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light font-16">Withdraw
										Money</span><br>
									<span class="weight-500 uppercase-font txt-light font-13">PENDING RS: <span class="counter-anim">{{
		                            $pending_withdraw_money }}</span></span><br>
		                            <span class="weight-500 uppercase-font txt-light font-13">SUCCESS RS: <span class="counter-anim">{{
		                            $withdraw_money }}</span></span><br>
		                             <span class="weight-500 uppercase-font txt-light font-13">CANCEL RS: <span class="counter-anim">{{
		                            $cancel_withdraw_money }}</span></span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>
			{{--<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-pink">
								<div class="container-fluid">
									<div class="row">
										<a href="">
											<div class=" pl-0 pr-0 data-wrap-left">
												<span class="weight-500 uppercase-font txt-light block font-16">Today
													Deposit</span>
												<span class="txt-light block counter"><span class="counter-anim">{{
														$today_deposit }}</span></span>
											</div>
											<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Total
										Bidding</span>
									<span class="txt-light block counter"><span class="counter-anim">{{
		$Total_bidding }}</span></span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Commission</span>
									<span class="txt-light block counter"><span
											class="counter-anim">{{$total_commission}}</span></span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Winning
										Amount</span>
									<span class="txt-light block counter"><span class="counter-anim">{{
		$today_win }}</span></span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="javascript:void(null)">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Profit</span>
									<span class="txt-light block counter">
										<span class="counter-anim">{{ $todaypl }}</span>
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-money txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Disawar</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$Disawar}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $Disawar_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $Disawar_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>


			{{--<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Laxmi
										Darbar</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{ $laxmidarbar }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $laxmidarbar_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $laxmidarbar_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Rajdhani
										Gold </span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{ $rajdhanigold }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $rajdhanigold_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $rajdhanigold_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">TAJ</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$TajBet}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $TajBet_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $TajBet_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>--}}
			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Delhi
										Bazar</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$DelhiBazar}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $DelhiBazar_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $DelhiBazar_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class="col-xs-6   pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Shree
										Ganesh</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$ShreeGanesh}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $ShreeGanesh_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $ShreeGanesh_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Faridabad</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$Faridabad}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. {{ $Faridabad_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $Faridabad_pl }} </span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>


			{{--<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Matka
										Market</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$matkamarket}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										{{ $matkamarket_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $matkamarket_pl }}
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>--}}

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Ghaziabad</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$GhaziaBad}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										{{ $GhaziaBad_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . {{ $GhaziaBad_pl }}
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>


			{{--<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Avadh
										Express</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{ @$avadhexpress }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										{{ @$avadhexpress_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal .
										{{ @$avadhexpress_pl }}
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>--}}

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Gali</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{$GaliBet}}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										{{ $GaliBet_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal .
										{{ $GaliBet_pl }}
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div>



			{{-- close new --}}




			<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Playonlineds
										Time</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										{{ @$kgftime }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										{{ @$kgftime_winning }}</span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal .
										{{ @$kgftime_pl }}
									</span>
								</div>
								<div class="  pl-0 pr-0 data-wrap-right font-size-30">
									<i class="fa fa-users txt-light data-right-rep-icon"></i>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div> -->
			<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<div class="sm-data-box bg-pink">
									<div class="container-fluid">
										<div class="row">
											<a href="">
												<div class=" pl-5 pr-0 data-wrap-left">
													<span
														class="weight-500 uppercase-font txt-light block font-13">MORNING STAR </span>
													<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
														{{ @$morningstar }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. {{ @$morningstar_winning }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . {{ @$morningstar_pl }} </span>
												</div>
												<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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


				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<div class="sm-data-box bg-pink">
									<div class="container-fluid">
										<div class="row">
											<a href="">
												<div class=" pl-5 pr-0 data-wrap-left">
													<span
														class="weight-500 uppercase-font txt-light block font-13">LONDON BAZAAR </span>
													<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
														{{ @$londonbazaar }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. {{ @$londonbazaar_winning }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . {{ @$londonbazaar_pl }} </span>
												</div>
												<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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

				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<div class="sm-data-box bg-pink">
									<div class="container-fluid">
										<div class="row">
											<a href="">
												<div class=" pl-5 pr-0 data-wrap-left">
													<span
														class="weight-500 uppercase-font txt-light block font-13">DEV DARSHAN </span>
													<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
														{{ @$devdarshan }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. {{ @$devdarshan_winning }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . {{ @$devdarshan_pl }} </span>
												</div>
												<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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

				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<div class="sm-data-box bg-pink">
									<div class="container-fluid">
										<div class="row">
											<a href="">
												<div class=" pl-5 pr-0 data-wrap-left">
													<span
														class="weight-500 uppercase-font txt-light block font-13">NEPAL BORDER </span>
													<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
														{{ @$nepalborder }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. {{ @$nepalborder_winning }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . {{ @$nepalborder_pl }} </span>
												</div>
												<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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

				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<div class="sm-data-box bg-pink">
									<div class="container-fluid">
										<div class="row">
											<a href="">
												<div class=" pl-5 pr-0 data-wrap-left">
													<span
														class="weight-500 uppercase-font txt-light block font-13">INDIA CLUB </span>
													<span class="weight-500 uppercase-font txt-light font-10">Bidding Rs.
														{{ @$indiaclub }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. {{ @$indiaclub_winning }}</span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . {{ @$indiaclub_pl }} </span>
												</div>
												<div class="  pl-0 pr-0 data-wrap-right font-size-30">
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

	<!-- <script>
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = year + "-" + month + "-" + day;

		document.getElementById("cdate").value = today;
	</script>
	
	-->

	<script>
    window.onload = function () {
        var dateInput = document.getElementById("cdate");
        if (!dateInput.value) { // Only set date if it's empty
            var date = new Date();
            var day = ("0" + date.getDate()).slice(-2);
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();
            dateInput.value = year + "-" + month + "-" + day;
        }
    };
</script>

@endpush