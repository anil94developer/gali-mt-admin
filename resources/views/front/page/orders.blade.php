@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Orders</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-9">
						
						<div class="cart_table table-responsive">
							<table class=" table">
								<thead>
									<tr>
										<th>PRODUCTS</th>
										<th>PRODUCT DETAIL</th>
										<th>TOTAL</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, 
											<p><span style="color:#03a8ea;">Price Rs. 400 </span><br>Quantity: 7</p>
										</td>
										
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, 
											<p><span style="color:#03a8ea;">Price Rs. 400 </span><br>Quantity: 7</p>
										</td>
										
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, 
											<p><span style="color:#03a8ea;">Price Rs. 400 </span><br>Quantity: 7</p>
										</td>
										
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									
									
								</tbody>
							</table>
							
						</div>
						<div class="row">
							<div class="col-md-10"></div>
							<div class="col-md-2">
								<div class="proceed_repeat">
									<a href="success.html">Repeat order</a>
								</div>
							</div>
						</div>
						<div class="cart_table1">
							<input type="radio" id="html" name="fav_language" value="">
							<label for="html"><img src="images/PhonePe.png"></label><br>
							<input type="radio" id="css" name="fav_language" value="">
							<label for="css"><img src="images/razorpay.png"></label><br>
							<input type="radio" id="javascript" name="fav_language" value="">
							<label for="javascript"><img src="images/Paypal.png"></label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cart_right">
							
							<h5 class="cart_add">Cart Totals</h5>
							<div class="right_price">
								<ul>
									<li>
										<span>Item(s) Subtotal </span>
										<span style="float: right;"> RS. 26899</span>
									</li>
									<li>
										<span>Items Discount</span>
										<span style="float:right; color: green;">-60</span>
									</li>
									<li>Shipping charges</li>
									<li>
										<span><b>Total Payable Amount</b></span>
										<span style="float:right;color: #03A8EA;">RS. 26899</span>
									</li>
								</ul>
							</div>
							<h5 class="billing_add">Billing Address</h5>
							<div class="billing">
								<ul>
									<li>User Name</li>
									<li>Address </li>
									<li>Pincode</li>
									<li>Phone no.</li>
									<li>Billing Address</li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection