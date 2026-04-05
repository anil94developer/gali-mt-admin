@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="index.html">Home  | </a></li>
						<li>Product</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-3">
						<div class="site_bar">
							<h3>CATEGORIES</h3>
							<div class="check_box">
								<form>
									<input type="checkbox" name="vehicle1" value="Bike">
									<label for="vehicle1"> Angle Cock</label><br>
									<input type="checkbox" name="vehicle2" value="Car">
									<label for="vehicle2"> Aquant</label><br>
									<input type="checkbox" name="vehicle3" value="Boat">
									<label for="vehicle3"> Artize</label><br>
									<input type="checkbox" name="vehicle1" value="Bike">
									<label for="vehicle1"> Angle Cock</label><br>
									<input type="checkbox" name="vehicle2" value="Car">
									<label for="vehicle2"> Aquant</label><br>
									<input type="checkbox" name="vehicle3" value="Boat">
									<label for="vehicle3"> Artize</label>
								</form>
							</div>
							<div class="price_range">
								<h5>PRICE RANGE</h5>
							  	<div class="row">
								    <div class="col-sm-12">
								      <div id="slider-range"></div>
								    </div>
								</div>
								<div class="row slider-labels">
								    <div class="col-md-6 ">
								      <strong>Min:</strong><span id="slider-range-value1"></span>
								    </div>
								    <div class="col-md-6 text-right ">
								      <strong>Max:</strong> <span id="slider-range-value2"></span>
								    </div>
								</div>
							</div>
							<div class="colors">
								<h5>COLOR</h5>
								<div class="custom-radios">
								  <div>
								    <input type="radio" id="color-1" name="color" value="color-1" checked>
								    <label for="color-1">
								      <span>
								        <i class="fa fa-check"></i>
								      </span>
								    </label>
								  </div>
								  
								  <div>
								    <input type="radio" id="color-2" name="color" value="color-2">
								    <label for="color-2">
								      <span>
								        <i class="fa fa-check"></i>
								      </span>
								    </label>
								  </div>
								  
								  <div>
								    <input type="radio" id="color-3" name="color" value="color-3">
								    <label for="color-3">
								      <span>
								        <i class="fa fa-check"></i>
								      </span>
								    </label>
								  </div>

								  <div>
								    <input type="radio" id="color-4" name="color" value="color-4">
								    <label for="color-4">
								      <span>
								        <i class="fa fa-check"></i>
								      </span>
								    </label>
								  </div>
								</div>
							</div>
						</div>
						<div class="list_image">
							<img src="{{URL::asset('front')}}/assets/images/product_list.png" width="100%">
						</div>
					</div>
					<div class="col-md-9">
						<div class="site_left">
							<div class="row">
								<div class="col-md-12">
									<div class="float-right">
										<i class="fa fa-sort-amount-desc"></i> &nbsp;&nbsp;
										<i class="fa fa-th-list"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href=""><i class="fa fa-heart"></i></a>
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-heart"></i></a>
									  		<a href="product_detail.html"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-heart"></i></a>
									  		<a href="product_detail.html"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-heart"></i></a>
									  		<a href="product_detail.html"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-heart"></i></a>
									  		<a href="product_detail.html"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
								<div class="col-md-4">
									<div class="product_box">
								  		<img src="{{URL::asset('front')}}/assets/images/product1.jpg" width="100%">
								  		<div class="product_text">
								  			<h5>Product name</h5>
								  			<p>
								  				Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								  			</p>
								  			<ul>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  				<li><i class="fa fa-star"></i></li>
								  			</ul>
								  			<div class="prices">
								  				<p>Rs.400 <span><del>Rs.500</del></span></p>
								  			</div>
								  		</div>
								  		<div class="overlays">
									  		<a href="{{url('/product/details/wishlist')}}"><i class="fa fa-heart"></i></a>
									  		<a href="product_detail.html"><i class="fa fa-eye"></i></a>
									  		<a href="{{url('product/cart')}}"><i class="fa fa-shopping-cart "></i></a>
								  		</div>
								  	</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection