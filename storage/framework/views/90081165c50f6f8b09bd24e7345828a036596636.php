
<?php $__env->startSection('content'); ?>
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="<?php echo e(url('/')); ?>">Home  | </a></li>
						<li>My Account</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="leftside-tabs mb-5 col-md-3">
						<div class="profile-box">
	                       <img src="<?php echo e(URL::asset('front')); ?>/assets/images/product1.jpg">
	                       
	                       <h6 class="m-0">Hii, Gfggdklkl </h6> 
	                    </div>
	                    <div class="deshboard-menu mt-3">
                        <ul>
                            <li class="active">
                                <a href="<?php echo e(url('my-account')); ?>">My Account <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                             <li>
                                <a href="<?php echo e(url('my-address')); ?>">My Address<span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('my-order')); ?>">My Orders <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                                                        <li>
                                <a href="<?php echo e(url('change_password')); ?>">Change Password <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a class="logout" href=""><i class="fa fa-sign-out mr-1"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
					</div>
					<div class="col-md-9">
					<div class="addres-form">
                    <h5>PERSONAL DETAIL</h5>
                    <form method="POST" action="#" class="theme-form" name="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">First Name*</label>
                                <input type="text" class="form-control" name="f_name"  placeholder="Enter First name" value="">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="lname">Last Name*</label>
                                <input type="text" class="form-control"  name="l_name" placeholder="Last Name" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="mobile">Phone Number*</label>
                                <input type="text" class="form-control" value="" name="mobile" placeholder="Enter your number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value=""> 
                            </div>
                        </div>
                            <div class="col-md-12">
                                <button class="btn btn-submit d-inline-block w-auto px-4" id="profile" type="submit">Update Profile</button>
                            </div>
                        </div>   
                    </form>
                </div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/front/page/my_account.blade.php ENDPATH**/ ?>