@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Success</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-12">
						<div class="success_page">
							<div class="success"><i class="fa fa-check"></i></div>
							<h4>Message Received</h4>
							<p>We are delighted to inform you that we received your payments</p>
							<button type="botton" value="" name="" class="success_button">CONTINUE</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection