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
	   $date=date('Y-m-d',strtotime('2022-12-01'));
	        $limit = 15;
            $initial_page=1;
            $page=$_POST['page'];
             if($page=="" || $page==null)
             {
               $page_number=1;
              
             }
             else
             {
               $page_number=$page;
               $initial_page = ( $page_number-1 ) * $limit;
             } 
			 
       $res=mysqli_query($conn, "SELECT * FROM point_table WHERE user_id='".$usrId."'  and DATE(created_at)>='".$date."' order by id desc limit $initial_page,$limit");
       $arrayList=array();
		 while($row21 = mysqli_fetch_assoc($res))
		 {
			$array=array();
			$array['transaction_id']=$row21['created_at'];
			$array['amount']=$row21['tr_value'];
			$array['market']=$row21['table_id'];
			$array['t_type']=$row21['tr_value_type'];
			$array['status']=$row21['tr_status'];
			$array['closing_balance']=$row21['tr_value_updated'];
			$array['datetime']= date('d-m-Y h:i:s a',strtotime($row21['created_at']));
			$arrayList[]=$array;
		 }
	
         $rows['success'] = "1";
         $rows['message'] = "Wallet Report List";
         $rows['data'] = $arrayList;
		 

}
  
echo (json_encode($rows));


