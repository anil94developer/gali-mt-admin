@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Checkout </li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-9">
						<div class="select_address">
							<h6>Select Address</h6>
							<div class="select_add">
								<div class="row">
									<div class="col-md-8">
										<select class="form-control" name="select_address">
                        					<option value="">Select Address</option> 
                                            <option value="">Address</option> 
                                        </select>
									</div>
									<div class="col-md-4">
										<button id="flip" class="btn btn-submit d-inline-block">Add New Address</button>
									</div>
								</div>
								<div class="sies" style="display:none;">
									<h6>Billing Info</h6>
									<form class="main-form full" id="main-form">
										<div class="row">
											<div class="col-md-6">
												<label>First Name*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Last Name*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Email Address*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Phone*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-12">
												<label>Address*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Postcode*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>City*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Country*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-6">
												<label>State*</label>
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
											<div class="col-md-12">
												<button type="botton" value="" name="" class="btn btn-next">Next</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cart_right">
							<h5>Order Summery</h5>
							<div class="summery">
								<ul>
									<li style="float:left; width: 30%;">
										<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
									</li>
									<li style="width: 70%; padding-left: 10px;">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
										<p><b>Quantity : 1</b></p>
										<p><b>Price : 26899</b></p>
									</li>
								</ul>
							</div><br>
							<h5>Price Details</h5>
							<div class="right_price">
								<ul>
									<li>
										<span>Cart Total </span>
										<span style="float: right;">RS. 26899</span>
									</li>
									<li>
										<span>Delivery Charges</span>
										<span style="float:right; color: green;">Free</span>
									</li>
									<li>
										<span><b>Total Payable Amount</b></span>
										<span style="float:right;color: #03A8EA;">RS. 26899</span>
									</li>
								</ul>
							</div>
							<div class="check_button">
								<a href="orders.html">
								<button type="botton" value="" name="" class="check_button_1">Checkout</button>
								</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection