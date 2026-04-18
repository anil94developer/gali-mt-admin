
	<link rel="stylesheet" type="text/css" href="{{URL::asset('front')}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('front')}}/assets/css/font-awesome.css">
	<script src="{{URL::asset('front')}}/assets/js/jquery.min.js"></script>
  <script src="{{URL::asset('front')}}/assets/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Gabriela&amp;family=Poppins:ital,wght@0,400;0,500;1,400&amp;family=Roboto&amp;display=swap" rel="stylesheet">

<style>
	.rightimage{
		width:120px;
		margin:auto;
	}
	.rightimage img{
     width:100%;
	}
li
{
	list-style: none;
	float: left;
	padding-right: 10px;
	margin-bottom: 10px;
}
.contact-detail i
{
    width: 10%;
    float: left;
    font-size: 25px;
     line-height: 40px;
}
.contact-detail p
{
    float: left;
    width: 90%;
    line-height: 40px;
    padding-left: 20px;
}
.contact_form {
    width: 90%;
    margin: auto;
    position: relative;
    background-color: #fff;
    box-shadow: 0 0 10px #ddd;
    border-radius: 5px;
}
.contact-detail {
    display: inline-block;
    height: 100%;
    background-color: #e78827;
    padding: 40px;
	
    width: 100%;
    color: #fff;
}
.contact_title {
    padding: 20px;
}
.contact-detail h6
{
    margin-bottom: 20px;
}
.contact-detail a
{
    text-decoration: none;
    color: #fff;
}
.btn-contact
{
    background-color:#dc3545;
    color: #fff;
    border: 1px solid #dc3545;
}
</style>
<div class="product_list">
		<div class="container-fluid">
			

			<div class="contact-page">
				<h2 class="text-center  text-light my-4 p-1 rounded" style="background:#e78827">Contact Us</h2>
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
											<input type="text" name="" value="" class="form-control" id="name" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone Number *</label>
											<input type="text" name="" value="" class="form-control" id="phone" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email Adderss *</label>
											<input type="text" name="" value="" class="form-control" id="email" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Subject *</label>
											<input type="text" name="" value="" class="form-control" id="subject" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Write Your Message *</label>
											<textarea rows="4" class="form-control" required ></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="buttons">
											<button  type="submit" class="btn btn-contact" id="submitData"
										style="background:#e78827">SUBMIT</button>
										</div>
										
									</div>
								</div>
							</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="contact-detail">
								<h6>7STAR</h6>
								<ul>
									
									<li><i class="fa fa-envelope-o"></i>
										<p>
											<a href="mailto:playonlineds2025@gmail.com">playonlineds2025@gmail.com</a>
										</p>
									</li>
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



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Thank You </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<div class="rightimage">
		<img src="https://cdn3.iconfinder.com/data/icons/simple-web-navigation/165/tick-512.png">
	</div>
		  <h4 class="text-center p-3">
		   Your submission has beem received. Please Check your email For confimation
		  </h4>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

//Show input error messages
function showError(input, message) {
    const formControl = input.parentElement;
    formControl.className = 'form-control error';
    const small = formControl.querySelector('small');
    small.innerText = message;
}

//show success colour
function showSucces(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}
$(document).on('click','#submitData',function(){
	var name = $('#name').val();
	var phone = $('#phone').val();
	var subject = $('#subject').val();
	var email = $('#email').val();
	if(name && phone && subject && email){
		Swal.fire({
			position: "center",
			icon: "success",
			title: "Successfully",
			showConfirmButton: false,
			timer: 11000
			});
	}else{
		
	}
});	
//check email is valid
function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(input.value.trim())) {
        showSucces(input)
    }else {
        showError(input,'Email is not invalid');
    }
}


//checkRequired fields
function checkRequired(inputArr) {
    inputArr.forEach(function(input){
        if(input.value.trim() === ''){
            showError(input,`${getFieldName(input)} is required`)
        }else {
            showSucces(input);
        }
    });
}


//check input Length
function checkLength(input, min ,max) {
    if(input.value.length < min) {
        showError(input, `${getFieldName(input)} must be at least ${min} characters`);
    }else if(input.value.length > max) {
        showError(input, `${getFieldName(input)} must be les than ${max} characters`);
    }else {
        showSucces(input);
    }
}

//get FieldName
function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// check passwords match
function checkPasswordMatch(input1, input2) {
    if(input1.value !== input2.value) {
        showError(input2, 'Passwords do not match');
    }
}


//Event Listeners
// form.addEventListener('submit',function(e) {
//     e.preventDefault();

//     checkRequired([username, email, password, password2]);
//     checkLength(username,3,15);
//     checkLength(password,6,25);
//     checkEmail(email);
//     checkPasswordMatch(password, password2);
// });
</script>