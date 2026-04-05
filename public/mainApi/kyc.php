<?php 
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$user_id = $_POST['user_id'];
//$pan_number  = $_POST['pan_number'];
$aadhar_number = $_POST['aadhar_number'];
//$name  = $_POST['name'];
//$pincode = $_POST['pincode'];
 if($user_id=='' &&  $aadhar_number==''){
	     $rows['success'] = "0";
		 $rows['message'] = "Error"; 
		 echo (json_encode($rows));
		 exit;
 }
 else
 {
	 $sql1=mysqli_query($conn, "SELECT * FROM user_kyc WHERE aadhar_number='".$aadhar_number."'");
		$count1 = mysqli_num_rows($sql1);
	    if($count1==0){
			
	 
		if (isset($_FILES["video"]["name"])) {
		  $filename = $_FILES["video"]["name"];
		  $tempname = $_FILES["video"]["tmp_name"];
		  $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["video"]["name"]));
		  $folder = "uploads/kyc/".$newfilename;
		  // Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder)) {
				$video=$newfilename;
			} else {
				$video="";
			}
		}
		
		if (isset($_FILES["aadhar_front"]["name"])) {
		  $filename = $_FILES["aadhar_front"]["name"];
		  $tempname = $_FILES["aadhar_front"]["tmp_name"];
		  $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["aadhar_front"]["name"]));
		  $folder = "uploads/kyc/".$newfilename;
		  // Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder)) {
				$aadhar_front=$newfilename;
			} else {
				$aadhar_front="";
			}
		}
		if (isset($_FILES["aadhar_back"]["name"])) {
		  $filename = $_FILES["aadhar_back"]["name"];
		  $tempname = $_FILES["aadhar_back"]["tmp_name"];
		  $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["aadhar_back"]["name"]));
		  $folder = "uploads/kyc/".$newfilename;
		  // Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder)) {
				$aadhar_back=$newfilename;
			} else {
				$aadhar_back="";
			}
		}
		
		
		$sql=mysqli_query($conn, "SELECT * FROM user_kyc WHERE user_id='".$user_id."'");
		$count = mysqli_num_rows($sql);
	    if($count > 0){
			
		  $sql = "update user_kyc set user_id='".$user_id."',video='".$video."',aadhar_back_image='".$aadhar_back."',aadhar_front_image='".$aadhar_front."',aadhar_number='".$aadhar_number."' where user_id='".$user_id."'";       
		  
		  mysqli_query($conn,$sql);
		 $sql1 = "update us_reg_tbl set is_kyc='1' where user_id='".$user_id."'";       
		 mysqli_query($conn,$sql1);
		 $rows['success'] = "1";
		 $rows['message'] = "KYC updated successfully===image $aadhar_back";	 
		 echo (json_encode($rows));
				 exit;
		
		}
		else
		{
		
		 $sql = "INSERT INTO `user_kyc`(`user_id`, `video`, `aadhar_number`,`aadhar_back_image`,`aadhar_front_image`) 
				VALUES ('$user_id','$video', '$aadhar_number','$aadhar_back','$aadhar_front')"; 
		 mysqli_query($conn,$sql);
		 
		 $sql1 = "update us_reg_tbl set is_kyc=1 where user_id='".$user_id."'";       
		 mysqli_query($conn,$sql1);
		  
		  
		 $rows['success'] = "1";
		 $rows['message'] = "KYC submitted successfully";	 
		 echo (json_encode($rows));
				 exit;
					 
		}
		}
		else
		{
			 $rows['success'] = "0";
			 $rows['message'] = "Dublicate aadhar number is not allowed"; 
			 echo (json_encode($rows));
			 exit;
		}
 }
