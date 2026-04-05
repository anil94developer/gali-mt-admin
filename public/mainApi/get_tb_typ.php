<?php 
include("config.php");


$devId     = $_POST['dev_id'];
$appId     = $_POST['app_id'];
$usrId     = $_POST['user_id'];

 



     
  if($appId=='' || $devId=='' || $usrId == ''){
	  
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  }else{




$chk_user=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='".$usrId."' AND app_id = '".$appId."' AND user_status = '1'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);


if($count_chk_user > 0){

  $sqler=mysqli_query($conn, "SELECT * FROM `tbl_types` WHERE  app_id = '".$appId ."' AND tbl_status = '1'");


	$count = mysqli_num_rows($sqler);
	    
	    if($count > 0){
			
			
			$i=0;
	 while($row2 = mysqli_fetch_assoc($sqler))
	 {	
			
			
		$rows['success'] = "1";
        $rows['message'] = "transactions details success";
		$rows['data'][$i] = $row2;
		
		
	$i++;
	 }
		
}else{

         $rows['success'] = "0";
		 $rows['message'] = "No data Available Or May Be Something went wrong"; 
		 echo (json_encode($rows));
		 exit;
		 
		 
}
}else{


	    
	    $rows['success'] = '3';
		 $rows['message'] = 'User Not Exits Or Blocked Please Check Again' ; 
		 echo (json_encode($rows));
		 exit; 
	    
	

}



}
 
echo (json_encode($rows));