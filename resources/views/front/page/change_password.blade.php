@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="index.html">Home  | </a></li>
						<li>Change Password</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="leftside-tabs mb-5 col-md-3">
						<div class="profile-box">
	                       <img src="images/product1.jpg">
	                       
	                       <h6 class="m-0">Hii, Gfggdklkl </h6> 
	                    </div>
	                    <div class="deshboard-menu mt-3">
                        <ul>
                            <li>
                                <a href="my_account.html">My Account <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                             <li>
                                <a href="my_address.html">My Address<span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="my_order.html">My Orders <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li  class="active">
                                <a href="change_password.html">Change Password <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a class="logout" href=""><i class="fa fa-sign-out mr-1"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
					</div>
					<div class="col-md-9">
						<div class="addres-form mt-sm">
                    <h5>Change Password</h5>
                    <form method="POST" action="#"  class="theme-form" name="change-password" id="change-password" >
                     <div class="row">
                         <div class="password_message text text-center"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Current Password*</label>
                                <input type="text" class="form-control valid" name="current_password" id="current_password" placeholder="Enter Current Password" value="" autocompleted="" aria-required="true" aria-invalid="false">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">New Password*</label>
                                <input type="password" class="form-control valid" name="password" id="password" placeholder="Enter New Password" value="" autocompleted="" aria-required="true" aria-invalid="false">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Confirm Password*</label>
                                <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm New Password" value="">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <button type="button" class="btn btn-submit d-inline-block w-auto px-4" id="change">Update Password</button>
                        </div>
                        
                    </div>
                        
                    </form>

                </div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection