@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Blog</li>
					</ul>
				</div>
			</div>
			<div class="product_top">
				<div class="row">
					<div class="col-md-9">
						<div class="blog_outer">
							<div class="box_blog">
								<div class="row">
									<div class="col-md-6">
										<a href="{{url('blog/blog-details')}}">
										<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
										</a>
									</div>
									<div class="col-md-6">
										<div class="box_blog_1">
										<a href="{{url('blog/blog-details')}}">
										<h4>Lorem Ipsum Lorem Ipsum</h4>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis. Ut at congue orci. Phasellus commodo massa libero. Nulla facilisi.
										</p>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis. 
										</p>
										
										<div class="dates">
											<i class="fa fa-calendar-o"></i>  16 Feb, 2021
										</div>
										</a>
									</div>
									</div>
								</div>
							</div>
							<div class="box_blog">
								<div class="row">
									<div class="col-md-6">
										<div class="box_blog_2">
											<a href="{{url('blog/blog-details')}}">
										<h4>Lorem Ipsum Lorem Ipsum</h4>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis. Ut at congue orci. Phasellus commodo massa libero. Nulla facilisi.
										</p>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis.
										</p>
										
										<div class="dates">
											<i class="fa fa-calendar-o"></i>  16 Feb, 2021
										</div>
										</a>
									</div>
									</div>
									<div class="col-md-6">
										<a href="{{url('blog/blog-details')}}">
										<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
										</a>
									</div>
								</div>
							</div>
							<div class="box_blog">
								<div class="row">
									<div class="col-md-6">
										<a href="{{url('blog/blog-details')}}">
										<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
									</a>
									</div>
									<div class="col-md-6">
										<div class="box_blog_1">
											<a href="{{url('blog/blog-details')}}">
										<h4>Lorem Ipsum Lorem Ipsum</h4>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis. Ut at congue orci. Phasellus commodo massa libero. Nulla facilisi.
										</p>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus dolor sed purus tempus convallis.
										</p>
										
										<div class="dates">
											<i class="fa fa-calendar-o"></i>  16 Feb, 2021
										</div>
									</a>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="blog_right">
							<h4>Category</h4>
							<ul>
								<li><a href="{{url('blog/blog-details')}}"><i class="fa fa-chevron-left"></i> Home Improvement</a></li>
								<li><a href="{{url('blog/blog-details')}}"><i class="fa fa-chevron-left"></i> Home Improvement</a></li>
								<li><a href="{{url('blog/blog-details')}}"><i class="fa fa-chevron-left"></i> Home Improvement</a></li>
							</ul>
						</div>
						<div class="latest_blogs">
							<h4>Latest Blogs</h4>
							<ul>
								<li><a href="{{url('blog/blog-details')}}">
									<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..... </p>
								</a></li>
								<li><a href="{{url('blog/blog-details')}}">
									<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..... </p>
								</a></li>
								<li><a href="{{url('blog/blog-details')}}">
									<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..... </p>
								</a></li>
								<li><a href="{{url('blog/blog-details')}}">
									<img src="{{URL::asset('front')}}/assets/images/about-images.png" width="100%">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..... </p>
								</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection