<div class="multivendor_website">
	<header>
		<div class="top_header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-6">
						<ul class="top_menus">
							<!--<li><a href="tel:73400 10077"><i class="fa fa-phone"></i> 91+ 93581 78480</a></li>-->
							<li><a href="tel:<?php echo e($select?$select->whatsapp:''); ?>"><i class="fa fa-phone"></i> 91+ 12345 67890 </a></li>

							<li><a href="mailto::dubaiKing2025@gmail.com"><i class="fa fa-envelope-o"></i> dubaiKing2025@gmail.com</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-6">
						<ul class="top_menus1">
							<li><a href=""><i class="fa fa-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-instagram"></i></a></li>
							<li><a href=""><i class="fa fa-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom_header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 col-3">
						<div class="logo_image">
							<a href="<?php echo e(url('/')); ?>">
							<img src="<?php echo e(URL::asset('front')); ?>/assets/images/KGF.png" alt="logo image" width="100px">
							
							</a>
						</div>
					</div>
					<div class="col-md-5 col-9">
						<div class="search_box">
							<form>
								<div class="form-group">
									<input type="text" name="" value="" class="form-control">
								</div>
								<button type="botton" value="" name="" class="btn btn_search"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
					<div class="col-md-4 col-12">
						<div class="top_icon">
							<ul>
								<li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b></a>
		              <ul class="dropdown-menu">
		                <li><a href="#" data-toggle="modal" data-target="login">Login</a></li>
		                <li><a href="#"data-toggle="modal" data-target="sign_up">Sign UP</a></li>
		                <li><a href="<?php echo e(url('my-account')); ?>">My Account</a></li>
		              </ul>
		            </li>
								<li><a href="<?php echo e(url('product/details/wishlist')); ?>"> <i class="fa fa-heart"></i></a>
									<div class="counts">
										<span>0</span>
									</div>
								</li>
								<li><a href="<?php echo e(url('product/cart')); ?>"> <i class="fa fa-shopping-cart"></i></a>
									<div class="counts">
										<span>0</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header">
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			  
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			     <ul class="navbar-nav mr-auto">
			      	<li class="nav-item">
			        	<a class="nav-link" href="<?php echo e(url('/')); ?>">HOME</a>
			      	</li>
			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          CATEGORIES
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <div class="container-fluid" style="display: block;">
				            <div class="row">
				              <div class="col-md-4">
				                <span class="text-uppercase text-white">Category 1</span>
				                <ul class="nav flex-column">
				                <li class="nav-item">
				                  <a class="nav-link active" href="<?php echo e(url('product/product-list')); ?>">Active</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				              </ul>
				              </div>
				             	<div class="col-md-4">
				                <ul class="nav flex-column">
				                <li class="nav-item">
				                  <a class="nav-link active" href="<?php echo e(url('product/product-list')); ?>">Active</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				              </ul>
				              </div>
				              <div class="col-md-4">
				                <ul class="nav flex-column">
				                <li class="nav-item">
				                  <a class="nav-link active" href="<?php echo e(url('product/product-list')); ?>">Active</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				                <li class="nav-item">
				                  <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">Link item</a>
				                </li>
				              </ul>
				              </div>
				            </div>
				          </div>
				        </div>
			      	</li>
			      	<li class="nav-item">
			        <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">BEST SELLING</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo e(url('about-us')); ?>">ABOUT US</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo e(url('product/product-list')); ?>">NEW ARRIVALS</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo e(url('blog')); ?>">BLOG</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo e(url('contact-us')); ?>">CONTACT US</a>
			      </li>
			    </ul>
			   
			  </div>
			</nav>
		</div>
	</header><?php /**PATH /home/adminmatka/public_html/resources/views/front/includes/header.blade.php ENDPATH**/ ?>