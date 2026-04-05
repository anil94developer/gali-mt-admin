<?php 
include("config.php");
mysqli_set_charset($conn, 'utf8');
date_default_timezone_set('Asia/Kolkata');
$usrId     = $_POST['user_id'];
     
  if($usrId == ''){
	  
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  }else{
	  
    $res=mysqli_query($conn, "SELECT * FROM inbox WHERE NOT FIND_IN_SET('$usrId','user_id')");
	
	  while($row21 = mysqli_fetch_assoc($res))
	 {
		 $dta=$row21['user_id'].",".$usrId;
		 mysqli_query($conn, "update inbox set user_id='".$dta."' WHERE id='".$row21['id']."'");
		 
	 }
	
    $sqler=mysqli_query($conn, "SELECT * FROM `inbox` order by created_at desc");
	$count = mysqli_num_rows($sqler);
	    
	    if($count > 0){
			
			
	$i=0;
	 $arrayList=array();
	 while($row2 = mysqli_fetch_assoc($sqler))
	 {	
		$array=array();
        $array['title']="👉TITLE : ".$row2['title'];
        $array['description']="👉DATE : ".date('d-m-Y',strtotime($row2['created_at']))."<br>"."👉TIME : ".date('h:i a');	
        $array['time']=	"👉MESSAGE: ".str_replace('&nbsp;'," ",strip_tags($row2['message']))."\n"."🙏जय अघोरी बाबा की🙏";
        $arrayList[]=$array;
		
	 }

     
         $rows['success'] = "1";
         $rows['message'] = "Notification List";
         $rows['data'] = $arrayList;
		 

}
  }
echo (json_encode($rows));


