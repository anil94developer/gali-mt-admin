<div class="footer">
		<div class="container">
			<div class="footer_top">
				<div class="row">
					<div class="col-md-4">
						<div class="footer_link">
							<h4></h4>
							<img src="<?php echo e(URL::asset('front')); ?>/assets/images/KGF.png" width="100px">
							<p>
                     Playonlineds was started with a vision to provide quality home decor pieces to millions of Indian households at affordable prices.
							</p>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<div class="footer_link">
							<h4>Quick Link</h4>
							<ul>
								<li><a href="<?php echo e(url('about-us')); ?>">About US</a></li>
								<li><a href="<?php echo e(url('term-conditions')); ?>">Term & Conditions</a></li>
								<li><a href="<?php echo e(url('privacy-policy')); ?>">Privacy Policy</a></li>
								<li><a href="<?php echo e(url('contact-us')); ?>">Contact US</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer_link">
							<h4>Reach Us</h4>
							<ul>
								<li><a href="tel:+91 <?php echo e(data_get($select, 'whatsapp', '')); ?>">Phone: Call: +91 12345 67890</a></li>
								<li><a href="mailto:playonlineds2025@gmail.com">Email: playonlineds2025@gmail.com</a></li>
								<li><a href="">Adderss: Jaipur
								</a></li>
							</ul>
							<div class="socil_link">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-instagram"></i></a></li>
									<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_last">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="text-center">Copyright  2023 <a href="https://shyammatka.co.in"> Playonlineds </a> All rights reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="login">
  <div class="modal-dialog" style="max-width: 600px; top: 15%;">
    <div class="modal-content">
		  <div class="modal-body">
       	<div class="login-signup">
	       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			    </button>
              <div class="row">
                 <div class="col-md-6 pr-md-0">
                    <img src="<?php echo e(URL::asset('front')); ?>/assets/images/product1.jpg" class="login-baner img-fluid">
                 </div>
                 <div class="col-md-6 pl-md-0">
                    
                    <div class="auth-model" id="loginForm">
                       <div class="model-header">
                          <h4 class="text-center">Sign in your Account</h4>
                          <p class="tag-line text-center">To track your orders, manage your account and more.</p>
                       </div>
                       <div class="auth_msg"></div>
                       <div class="successMsg"></div>
                       <form method="POST" action="" class="form-horizontal">

                       <div class="form-group mb-3">
                          <input type="email" class="form-control" name="Mobile Number or Email Id" id="email" placeholder="Mobile Number or Email Id*" autocompleted="">
                       </div>
                       <!-- Password input -->
                       <div class="form-group mb-3">
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password*" autocompleted="">
                       </div>
                       <!-- 2 column grid layout for inline styling -->
                       <div class="row mb-3">
                          <div class="col-6">
                             <!-- Checkbox -->
                             <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3">
                                <label class="form-check-label" for="form1Example3">Remember me</label>
                             </div>
                          </div>
                          <div class="col-6">
                           <a data-toggle="modal" class="forget_pass_link" data-target="#forget_password" style="cursor: pointer;">
                              Forget Password ?
                            </a> 
                        </div>
                         
                       </div>
                       <div class="row">
                          <div class="col-12">
                             <button type="submit" id="login_user" class="btn btn-submit">LOGIN</button>
                          </div>
                          <div class="col-12">
                             <p class="text-left m-0">Don't have an account?<a href="javascript:void();" id="signnew" data-toggle="modal" data-target="#signuKGFdel" class="bbb"> Sign Up</a></p>
                          </div>
                          
                       </div>
                       
                       </form>
                    </div>
                 </div>
              </div>
           </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="forget_password">
  <div class="modal-dialog" style="max-width: 600px; top: 15%;">
    <div class="modal-content">
		  <div class="modal-body">
       	<div class="login-signup">
	       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			    </button>
              <div class="row">
                 <div class="col-md-6 pr-md-0">
                    <img src="images/product1.jpg" class="login-baner img-fluid">
                 </div>
                 <div class="col-md-6 pl-md-0">
                    
                    <div class="auth-model" id="loginForm">
                       <div class="model-header">
                          <h4 class="text-center">Forget Password ?</h4><br><br>
                       </div>
                       <div class="auth_msg"></div>
                       <div class="successMsg"></div>
                       <form method="POST" action="" class="form-horizontal">

                       <div class="form-group mb-3">
                          <input type="email" class="form-control" name="Mobile No."  placeholder="Mobile No.*" autocompleted=""><br>
                       </div>
                      
                       <div class="row">
                          <div class="col-12">
                             <button type="submit" id="login_user" class="btn btn-submit">Submit</button>
                          </div>
                     
                       </div>
                       
                       </form>
                    </div>
                 </div>
              </div>
           </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="sign_up">
  <div class="modal-dialog" style="max-width: 600px; top: 15%;">
    <div class="modal-content">
		
      <div class="modal-body">
       	<div class="login-signup">
	       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    			<span aria-hidden="true">×</span>
			    </button>
              <div class="row">
                 <div class="col-md-6 pr-md-0">
                    <img src="<?php echo e(URL::asset('front')); ?>/assets/images/product1.jpg" class="login-baner img-fluid">
                 </div>
                 <div class="col-md-6 pl-md-0">
                    
                    <div class="auth-model">
                       <div class="model-header">
                          <h4 class="text-center">Sign Up With Us</h4>
                          <p class="tag-line text-center">Get notified on exclusive discounts, newsletters and more</p>
                       </div>
                       <form method="POST" action="" class="form-horizontal">
                       	  <div class="form-group mb-3">
                          <input type="name" class="form-control" name="Name" placeholder="Name*" autocompleted="">
                       </div>
                       <div class="form-group mb-3">
                          <input type="email" class="form-control" name="Email Address" placeholder="Email Address*" autocompleted="">
                       </div>
                       <div class="row">
                       		<div class="col-md-6">
                       			<div class="form-group mb-3">
                          		<input type="phone" class="form-control" name="Phone" placeholder="Phone*" autocompleted="">
                       			</div>
                       		</div>
                       		<div class="col-md-6">
                       			<div class="form-group mb-3">
                          		<input type="pincode" class="form-control" name="Pincode" placeholder="Pincode*" autocompleted="">
                       			</div>
                       		</div>
                       </div>
                       <!-- Password input -->
                        <div class="form-group mb-3">
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password*" autocompleted="">
                       </div>
                       <div class="form-group mb-3">
                          <input type="password" class="form-control" name="Password Confirmation" placeholder="Password Confirmation*" autocompleted="">
                       </div>
                       
                      <div class="row">
                          <div class="col-12">
                             <button type="submit" id="login_user" class="btn btn-submit">SIGN UP</button>
                          </div>
                          <div class="col-12">
                             <p class="text-left m-0">Already have an account? <a href="javascript:void();" id="signnew" data-toggle="modal" data-target="#signuKGFdel" class="bbb"> Sign In</a></p>
                          </div>
                          
                       </div>
                       
                       </form>
                    </div>
                 </div>
              </div>
           </div>
      </div>

      

    </div>
  </div>
</div>
<script>
	$(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready

// breakpoint and up  
$(window).resize(function(){
  if ($(window).width() >= 980){  

      // when you hover a toggle show its dropdown menu
      $(".navbar .dropdown-toggle").hover(function () {
         $(this).parent().toggleClass("show");
         $(this).parent().find(".dropdown-menu").toggleClass("show"); 
       });

        // hide the menu when the mouse leaves the dropdown
      $( ".navbar .dropdown-menu" ).mouseleave(function() {
        $(this).removeClass("show");  
      });
  
    // do something here
  } 
});  
  
  

// document ready  
});
</script>
<script>
	$(document).ready(function()
{


if($('.bbb_viewed_slider').length)
{
var viewedSlider = $('.bbb_viewed_slider');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:2},
768:{items:3},
991:{items:4},
1199:{items:4}
}
});

if($('.bbb_viewed_prev').length)
{
var prev = $('.bbb_viewed_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next').length)
{
var next = $('.bbb_viewed_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});
	// tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");
	

	

$(document).ready(function()
{


if($('.bbb_viewed_slider1').length)
{
var viewedSlider = $('.bbb_viewed_slider1');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:3},
768:{items:3},
991:{items:4},
1199:{items:2}
}
});

if($('.bbb_viewed_prev1').length)
{
var prev = $('.bbb_viewed_prev1');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next1').length)
{
var next = $('.bbb_viewed_next1');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});
$(document).ready(function()
{


if($('.bbb_viewed_slider2').length)
{
var viewedSlider = $('.bbb_viewed_slider2');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:2},
575:{items:3},
768:{items:3},
991:{items:4},
1199:{items:4}
}
});

if($('.bbb_viewed_prev2').length)
{
var prev = $('.bbb_viewed_prev2');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next2').length)
{
var next = $('.bbb_viewed_next2');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});

</script>
<script>
	$(document).ready(function() {

$('.owl-carousel').owlCarousel({
mouseDrag:false,
loop:true,
margin:2,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:1
},
1000:{
items:2
}
}
});

$('.owl-prev').click(function() {
$active = $('.owl-item .item.show');
$('.owl-item .item.show').removeClass('show');
$('.owl-item .item').removeClass('next');
$('.owl-item .item').removeClass('prev');
$active.addClass('next');
if($active.is('.first')) {
$('.owl-item .last').addClass('show');
$('.first').addClass('next');
$('.owl-item .last').parent().prev().children('.item').addClass('prev');
}
else {
$active.parent().prev().children('.item').addClass('show');
if($active.parent().prev().children('.item').is('.first')) {
$('.owl-item .last').addClass('prev');
}
else {
$('.owl-item .show').parent().prev().children('.item').addClass('prev');
}
}
});

$('.owl-next').click(function() {
$active = $('.owl-item .item.show');
$('.owl-item .item.show').removeClass('show');
$('.owl-item .item').removeClass('next');
$('.owl-item .item').removeClass('prev');
$active.addClass('prev');
if($active.is('.last')) {
$('.owl-item .first').addClass('show');
$('.owl-item .first').parent().next().children('.item').addClass('prev');
}
else {
$active.parent().next().children('.item').addClass('show');
if($active.parent().next().children('.item').is('.last')) {
$('.owl-item .first').addClass('next');
}
else {
$('.owl-item .show').parent().next().children('.item').addClass('next');
}
}
});

});
</script>
<script>
	$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script><?php /**PATH C:\wamp64\www\adminmt\resources\views/front/includes/footer.blade.php ENDPATH**/ ?>