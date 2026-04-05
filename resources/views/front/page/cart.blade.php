@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Your Shopping Cart</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-9">
						<div class="cart_page">
							<div class="row">
								<div class="col-md-6 col-6">
									<div class="float-left"><b>My Cart:</b></div>
								</div>
								<div class="col-md-6 col-6">
									<div class="float-right"><b>3 Item</b></div>
								</div>
							</div>
						</div>
						<div class="cart_table table-responsive">
							<table class=" table">
								<thead>
									<tr>
										<th>PRODUCTS</th>
										<th>DELIVERY DATE</th>
										<th>QUANTITY</th>
										<th>TOTAL</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, </td>
										<td>
											<div class="qty-input">
												<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
												<input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
												<button class="qty-count qty-count--add" data-action="add" type="button">+</button>
											</div>
										</td>
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet,</td>
										<td>
											<div class="qty-input">
												<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
												<input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
												<button class="qty-count qty-count--add" data-action="add" type="button">+</button>
											</div>
										</td>
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet,</td>
										<td>
											<div class="qty-input">
												<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
												<input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
												<button class="qty-count qty-count--add" data-action="add" type="button">+</button>
											</div>
										</td>
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, </td>
										<td>
											<div class="qty-input">
												<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
												<input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
												<button class="qty-count qty-count--add" data-action="add" type="button">+</button>
											</div>
										</td>
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
									<tr>
										<td><img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="80px"></td>
										<td>Lorem ipsum dolor sit amet, </td>
										<td>
											<div class="qty-input">
												<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
												<input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
												<button class="qty-count qty-count--add" data-action="add" type="button">+</button>
											</div>
										</td>
										<td>Rs. 26899</td>
										<td  style="text-align: center; color: red; font-size: 20px;"><i class="fa fa-close"></i></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cart_right">
							<h5>Promo Code</h5>
							<div class="coupon">
								<input type="text" name="" value="" placeholder="Coupon" class="form-control">
								<button type="botton" name="" value="" class="btn btn-info">Apply</button>
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
								<a href="{{url('product/checkout')}}">
								<button type="botton" value="" name="" class="check_button_1">Checkout</button>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="proceed">
						<a href="">Continue Shopping <i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="proceed_check">
						<a href="">Update Shopping Cart <i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="proceed_check">
						<a href="">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection