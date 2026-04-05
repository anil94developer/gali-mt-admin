<?php  
  $amount = $_GET['amount'];
  $user_id = $_GET['userid'];
  $contact = $_GET['contact']; 
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dubai King - Add Money</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffeda0;
      font-family: 'Segoe UI', sans-serif;
    }
    .qr-section {
      text-align: center;
      margin-top: 40px;
    }
    .qr-image img {
      width: 280px;
      height: 280px;
      border: 5px solid #fff;
      border-radius: 12px;
    }
    .helpline {
      margin-top: 20px;
      font-size: 20px;
      color: green;
      font-weight: bold;
    }
    .helpline-number {
      color: #008000;
      font-size: 22px;
    }
    .instructions {
      margin-top: 30px;
      padding: 0 20px;
      font-size: 16px;
      color: #333;
    }
    .note {
      margin-top: 25px;
      padding: 0 20px;
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container text-center">

    <div class="qr-section">
      <h2 class="mb-3">QR को स्कैन करके Add Money करें</h2>
      <div class="qr-image">
        <img src="<?php echo e(URL::asset('/backend/uploads/Payment_qrcode/').'/'.$qr_code->image); ?>" alt="QR Code">
        <h4 class="mt-2">Amount : <?php echo $amount; ?> </h4>
      </div>

      <div class="helpline mt-4">
        Helpline Number - <span class="helpline-number">+91 <?php echo e($upi->help_line_number); ?></span>
      </div>

      <div class="instructions mt-4">
        अब आप QR को किसी भी मोबाइल से स्कैन करके AddMoney कर सकते हैं। AddMoney का समय 24 घंटे रहेगा।
      </div>

      <div class="note">
        नोट: पेमेंट ऐड करने के लिए QR कोड का स्क्रीनशॉट लेकर पेमेंट कीजिए और एक QR कोड पर एक बार ही पेमेंट करें!
      </div>
    </div>
  </div>
</body>
</html>




<!-- <?PHP  
 $amount= $_GET['amount'];
 $user_id= $_GET['userid'];
 $contact= $_GET['contact']; 
//  $intentData="upi://pay?pa=".$upi->upiId."&pn=KGF&tn=".$remark."&am=".$amount."&cu=INR";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Dubai King</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .image_qr{
      width: 100%;
      height: 300px;
    }
    .image_qr img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        
        <h1 class="mt-5">Welcome to Dubai King</h1>
      </div>
      <div class="col-md-12">
        <h3>Payment By Qr Code</h3>
        
        <div class="image_qr">
          <img src="<?php echo e(URL::asset('/backend/uploads/Payment_qrcode/').'/'.$qr_code->image); ?>">
        </div>

        <h4>Add : <?php echo $amount; ?> </h4>
      </div>

      <div class="col-md-12 mt-2 mb-5">
        <p style='margin-left: 21px; margin-top: 42px;'>आप इस QR Code पर स्कैन करके Payment कर सकते है | या आप Google Pay, phone pe, Paytm या Other UPI App अपलोड करके भी पेमेंट कर सकते है | तुरंत आप के वॉलेट मे बैलेंस आ जायेगा।</p>

        <p style='margin-left: 21px; margin-top: 42px; color:red;'>नोट : जब भी आपको वॉलेट  में बेलेंस ADD करवाना हो उसी समय ADD MONEY में AMOUNT  डाल कर नया QR CODE बना कर ही पेमेंट करे !</p>

        <p style='margin-left: 21px; margin-top: 42px;'>ADD MONEY नही होने की स्थिति मे व्हाट्सएप कॉल कर के जानकारी देवे एंड अपने आई डी व पेमेंट का स्क्रीनशॉट भेजे !</p>
      </div>
    </div>
  </div>
</body>

</html>

<script>
  window.onload = function () {
    var button = document.getElementById('clickButton');
    button.click();
  }
</script> -->


<?php /**PATH /home/dubaiking/public_html/Admin/resources/views/front/page/payment_by_scanner.blade.php ENDPATH**/ ?>