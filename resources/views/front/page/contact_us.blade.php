@extends('front.layout.layout')
@section('content')
<div class="product_list">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ul class="bard_product">
						<li><a href="{{url('/')}}">Home  | </a></li>
						<li>Contact Us</li>
					</ul>
				</div>
			</div>
			
			<div class="contact-page">
				<div class="row">
					<div class="col-md-12">
						<div class="map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14231.566335937063!2d75.72870093627176!3d26.90693566487684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db49e043a7acb%3A0xdad09ace57371810!2sVaishali%20Nagar%2C%20Jaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1639394536173!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>
					</div>
				</div>
				<div class="contact_form">
					<div class="row">
						<div class="col-md-6">
							<div class="contact_title">
								<h6>Contact</h6>
							
							<form>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Name *</label>
											<input type="text" name="" value="" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone Number *</label>
											<input type="text" name="" value="" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email Adderss *</label>
											<input type="text" name="" value="" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Subject *</label>
											<input type="text" name="" value="" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Write Your Message *</label>
											<textarea rows="4" class="form-control"></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="buttons">
											<button type="botton" value="" name="" class="btn btn-contact">SUBMIT</button>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="contact-detail">
								<h6>Lorem Ipsum Lorem Ipsum</h6>
								<ul>
									<li>
										<i class="fa fa-home"></i> <p>
										1/461, kargil hero khuti, near by Global Hospital Chitrakoot, Vaishali Nagar, Jaipur, Rajasthan 302021
										</p>
									</li>
									<li><i class="fa fa-envelope-o"></i>
										<p>
											<a href="mailto:playonlineds2025@gmail.com">playonlineds2025@gmail.com</a>
										</p>
									</li>
									<li><i class="fa fa-phone"></i> <p><a href="tel:+73400 10077">+91 12345 67890</a></p></li>
									<li><i class="fa fa-clock-o "></i> 
										<p><a href=""> Saturday : 10am - 7pm</a></p>
									</li>
									<!-- <li><i class="fa fa-clock-o "></i> 
										<p><a href=""> Sunday: Closed</a></p>
									</li> -->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection