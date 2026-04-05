<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Playonlineds</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12" >
        <h2 class="mt-1" style="color:red">Welcome to Playonlineds</h2>
      </div>
      
      <div class="col-md-12">
        <h3>UPI Payment</h3>
        <p class="mt-2"><span style="color:#FF8000">नीचे दिए हुए आइकॉन पे क्लिक करे </span> <b>( ANDROID USER)</b> 👇</p>
		<a  href="<?=$paytm_linka?>"><button  class="rounded bg-none btn btn-primary" style="border:2px solid #ccc; height:59px">PAYTM</button></a>
        
        <a  href="<?=$gpay_linka?>"><button  class="rounded bg-none btn btn-danger" style="border:2px solid #ccc; height:59px">Gpay</button></a>
       
        <a  href="<?=$phonepaya?>"><button  class="rounded bg-none btn btn-secondary text-white" style="border:2px solid #ccc; height:59px">PhonePay</button></a>
        
      </div>
      

      
     
      <div class="col-md-12 mt-1">
          
          <p class="mt-4"><span style="color:#FF8000">नीचे दिए हुए आइकॉन पे क्लिक करे</span>  <b>( IPHONE USER)</b> 👇</p>
		      
         <a  href="<?=$intentData2?>"><button  class="rounded bg-none btn btn-primary" style="border:2px solid #ccc; height:59px">PAYTM</button></a>
        
        <a  href="<?=$intentData1?>"><button  class="rounded bg-none btn btn-danger" style="border:2px solid #ccc; height:59px">Gpay</button></a>
       
        <a  href="<?=$intentData3?>"><button  class="rounded bg-none btn btn-secondary text-white" style="border:2px solid #ccc; height:59px">PhonePay</button></a>
        
        
        </div>
      

      <div class="col-md-12 mt-2 mb-5">
        <p style='margin-left: 21px; margin-top:10px;'>भुगतान करने के बाद बैक बटन दबाये 👇</p>
        <button
          style="background: crimson; margin: auto; /* text-align: center; */ display: block; padding: 8px 58px;       text-decoration: none; font-size: 35px; border-radius: 8px; box-shadow: none; outline: none; border: none; width:100%;">
          <a href="https://playonlineds.com/"
            style="margin-top: 5px; text-decoration: none; color: white;">Back</a>
        </button>
      </div>
    </div>
  </div>
</body>

</html>