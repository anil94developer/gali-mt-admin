@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="index.html">Home  | </a></li>
						<li>My Orders</li>
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
                             <li>
                                <a href="my_address.html">My Address<span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li class="active">
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
	                    	
                     		<form method="POST" action="" class="theme-form" name="my_address_form" >
                    			<div class="row">
                        			<div class="order-table table-responsive">
					                  	<table class="table">
					                      	<thead class="thead-light">
					                          	<tr>
					                             	<th scope="col">S.No</th>
					                              	<th scope="col">Order Date</th>
					                              	<th scope="col">Order id</th>
					                              	<th scope="col">No of Items</th>
					                              	<th scope="col">Last Updated</th>
					                              	<th scope="col">Status</th>
					                              	<th>Action</th>
					                          	</tr>
					                      	</thead>
					                      	<tbody>
					                      		<tr>
					                      			<td>1.</td>
					                      			<td>02/04/21</td>
					                      			<td>#ewe3433</td>
					                      			<td></td>
					                      			<td>dsfdsf</td>
					                      			<td>dsdsa</td>
					                      			<td><i class="fa fa-close"></i></td>
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