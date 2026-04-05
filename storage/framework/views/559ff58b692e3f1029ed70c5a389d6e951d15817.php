
<?php $__env->startSection('content'); ?>
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

		@media  screen and (max-width:767px) {
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
					

							<input type="date" name="select_date" value="<?php echo e($date); ?>" class="form-control"
								placeholder="Select Date" id="cdate" required>
						</div>
						<div class="">
							<button class="btn btn-success m-0">Search</button>
						</div>
						<div class="">
							<a href="<?php echo e(URL::to('/administrator/dashboard')); ?>" class="btn btn-success m-0">Refresh Today</a>
						</div>
					</div>
					<?php echo e(Form::close()); ?>


			</div>

			<!-- <?php echo e(Form::open(array('url' => URL::to('administrator/dashboard'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?> -->


			
			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-0 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Customer
										Balance</span>
									<span class="txt-light block counter"><span class="counter-anim"><?php echo e($customer_balance); ?></span></span>
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
										<span class="counter-anim"><?php echo e($add_money); ?></span>
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
									<span class="weight-500 uppercase-font txt-light font-13">PENDING RS: <span class="counter-anim"><?php echo e($pending_withdraw_money); ?></span></span><br>
		                            <span class="weight-500 uppercase-font txt-light font-13">SUCCESS RS: <span class="counter-anim"><?php echo e($withdraw_money); ?></span></span><br>
		                             <span class="weight-500 uppercase-font txt-light font-13">CANCEL RS: <span class="counter-anim"><?php echo e($cancel_withdraw_money); ?></span></span>
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
									<span class="weight-500 uppercase-font txt-light block font-16">Total
										Bidding</span>
									<span class="txt-light block counter"><span class="counter-anim"><?php echo e($Total_bidding); ?></span></span>
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
											class="counter-anim"><?php echo e($total_commission); ?></span></span>
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
									<span class="txt-light block counter"><span class="counter-anim"><?php echo e($today_win); ?></span></span>
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
										<span class="counter-anim"><?php echo e($todaypl); ?></span>
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
										<?php echo e($Disawar); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. <?php echo e($Disawar_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . <?php echo e($Disawar_pl); ?> </span>
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
									<span class="weight-500 uppercase-font txt-light block font-16">Delhi
										Bazar</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										<?php echo e($DelhiBazar); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. <?php echo e($DelhiBazar_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . <?php echo e($DelhiBazar_pl); ?> </span>
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
										<?php echo e($ShreeGanesh); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. <?php echo e($ShreeGanesh_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . <?php echo e($ShreeGanesh_pl); ?> </span>
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
										<?php echo e($Faridabad); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs. <?php echo e($Faridabad_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . <?php echo e($Faridabad_pl); ?> </span>
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
									<span class="weight-500 uppercase-font txt-light block font-16">Ghaziabad</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										<?php echo e($GhaziaBad); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										<?php echo e($GhaziaBad_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal . <?php echo e($GhaziaBad_pl); ?>

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


			

			<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Gali</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										<?php echo e($GaliBet); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										<?php echo e($GaliBet_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal .
										<?php echo e($GaliBet_pl); ?>

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



			




			<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<div class="card bg-pink">
					<div class="card-body">
						<div class="d-flex justify-content-between card_flex_custum">
							<a href="">
								<div class=" pl-5 pr-0 data-wrap-left">
									<span class="weight-500 uppercase-font txt-light block font-16">Dubai King
										Time</span>
									<span class="weight-500 uppercase-font txt-light font-13">Bidding
										Rs.
										<?php echo e(@$kgftime); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Wining
										Rs.
										<?php echo e(@$kgftime_winning); ?></span>
									<span class="weight-500 uppercase-font txt-light block font-13">Total
										Bal .
										<?php echo e(@$kgftime_pl); ?>

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
														<?php echo e(@$morningstar); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. <?php echo e(@$morningstar_winning); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . <?php echo e(@$morningstar_pl); ?> </span>
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
														<?php echo e(@$londonbazaar); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. <?php echo e(@$londonbazaar_winning); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . <?php echo e(@$londonbazaar_pl); ?> </span>
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
														<?php echo e(@$devdarshan); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. <?php echo e(@$devdarshan_winning); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . <?php echo e(@$devdarshan_pl); ?> </span>
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
														<?php echo e(@$nepalborder); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. <?php echo e(@$nepalborder_winning); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . <?php echo e(@$nepalborder_pl); ?> </span>
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
														<?php echo e(@$indiaclub); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Wining
														Rs. <?php echo e(@$indiaclub_winning); ?></span>
													<span class="weight-500 uppercase-font txt-light block font-10">Total
														Bal . <?php echo e(@$indiaclub_pl); ?> </span>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

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

<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminmatka/public_html/resources/views/administrator/dashboard/index.blade.php ENDPATH**/ ?>