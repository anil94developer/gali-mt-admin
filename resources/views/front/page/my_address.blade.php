@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>My Address</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="leftside-tabs mb-5 col-md-3">
						<div class="profile-box">
	                       <img src="{{URL::asset('front')}}/assets/images/product1.jpg">
	                       
	                       <h6 class="m-0">Hii, Gfggdklkl </h6> 
	                    </div>
	                    <div class="deshboard-menu mt-3">
                        <ul>
                            <li>
                                <a href="my_account.html">My Account <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                             <li class="active">
                                <a href="my_address.html">My Address<span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="my_order.html">My Orders <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                                                        <li>
                                <a href="change_password.html">Change Password <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a class="logout" href=""><i class="fa fa-sign-out mr-1"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
					</div>
					<div class="col-md-9">
						<div class="addres-form">
	                    	<h5 class="clearfix">Address DETAIL 
	                    		<a href="" class="btn btn-primary float-right">Add More Address </a>
	                    	</h5>
                     		<form method="POST" action="" class="theme-form" name="my_address_form" >
                    			<div class="row">
                        			<div class="address-cart table-responsive">
	                                    <table class="table">
	                                      	<thead>
		                                        <tr class="red">
		                                          <th>Name</th>
		                                          <th>Email</th>
		                                          <th>Mobile</th>
		                                          <th>Address</th>
		                                          <th>City</th>
		                                          <th></th>
		                                        </tr>
	                                      	</thead>
	                                      	<tbody>
                                           		<tr class="even">
		                                          <td>jslkj jslkj</td>
		                                          <td>j@gmail.com</td>
		                                          <td>8209433281</td>
		                                          <td>japujlkj</td>
		                                          <td>ghih</td>
		                                          <td><a href="" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?');">
		                                              <i class="fa fa-trash"></i>
		                                             
		                                          </a></td>
                                        		</tr>
                                                <tr class="odd">
		                                          	<td>ghgfhgf</td>
		                                          	<td>jtyt@gmail.com</td>
		                                          	<td>8209433281</td>
		                                          	<td>japujlkj</td>
		                                          	<td>ghihtytyt</td>
		                                          	<td><a href="" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?');">
		                                              <i class="fa fa-trash"></i>
		                                             
		                                          	</a></td>
		                                        </tr>
                                                <tr class="even">
		                                          	<td>ghgfhgf</td>
		                                          	<td>jtyt@gmail.com</td>
		                                          	<td>8209433281</td>
		                                          	<td>japujlkj</td>
		                                          	<td>ghihtytyt</td>
		                                          	<td><a href="" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?');">
		                                              <i class="fa fa-trash"></i>
		                                             
		                                          	</a></td>
		                                        </tr>
                                            </tbody>
                                    	</table>
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