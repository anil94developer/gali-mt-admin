<?PHP  
 $amount= $_GET['amount'];
 $user_id= $_GET['userid'];
 $contact= $_GET['contact']; 
 $name= $_GET['name']; 
 $intentData="upi://pay?pa=".$upi->upiId."&pn=playonlineds&tn=".$remark."&am=".$amount."&cu=INR";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Playonlineds</title>
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
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">

        <h1 class="mt-5">Welcome to Playonlineds</h1>
      </div>
      <div class="col-md-12">
      <h2 class="mb-3">QR को स्कैन करके Add Money करें</h2>
        <?php echo e($qrcode); ?>

      
        
        <form id="payment" method="post" action="<?php echo e(URL::to('user/upload-reciept')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="upi-payment-step">
             
            <div class="mb-3 text-center">
                <label for="upi-input" class="form-label" style="font-weight: bold; font-size: 18px;">Upload Receipt Image</label>
                <input class="form-control w-50 mx-auto" type="file" id="upi-input" name="image">
            </div>

              <input type="hidden" name="userid" value="<?php echo e($user_id); ?>" />
              <input type="hidden" name="contact" value="<?php echo e($contact); ?>" />
              <input type="hidden" name="name" value="<?php echo e($name); ?>" />
              <input type="hidden" name="upi" value="<?php echo e($general_settings->upiId); ?>" />
              <input type="hidden" name="amount" value="<?php echo e($amount); ?>" />
              <input type="hidden" name="transaction_id" value="<?php echo e($rand); ?>" />
          </div>

          <div class="text-center mt-3">
              <button type="submit" class="btn btn-success px-5 py-2">Submit Receipt</button>
          </div>
      </form>

    <div class="helpline mt-4">
        Helpline Number - <span class="helpline-number">+91 <?php echo e($upi->help_line_number); ?></span>
      </div>
       
      </div>


      <!-- <div class="col-md-12 mt-2 mb-5">
        <p style='margin-left: 21px; margin-top: 42px;'>भुगतान करने के बाद बैक बटन दबाये</p>
        <button
          style="background: crimson; margin: auto; /* text-align: center; */ margin-top: 120px; display: block; padding: 8px 58px;       text-decoration: none; font-size: 35px; border-radius: 8px; box-shadow: none; outline: none; border: none; width:100%;">
          <a href="https://playonlineds.com/"
            style="margin-top: 100px; text-decoration: none; color: white;">Back</a>
        </button>
      </div> -->
      <?php if($paymentInstruction->file == null): ?>
      <div class="instructions mt-4">
        अब आप QR को किसी भी मोबाइल से स्कैन करके AddMoney कर सकते हैं। AddMoney का समय 24 घंटे रहेगा।
      </div>


      <div class="col-md-12 mt-2 mb-5 note">
      <p style='margin-left: 21px; margin-top: 42px;'><?php echo e($paymentInstruction->description); ?></p>
      </div>

    <?php else: ?>
      <div style='margin-top: 80px;'>
      <br>
      <video width="320" height="240" controls>
        <source src="<?php echo e(URL::asset('backend/uploads/payment_instruction/' . $paymentInstruction->file)); ?>"
        type="video/mp4">
      </video>
      </div>
    <?php endif; ?>

    </div>
  </div>
</body>

</html>

<script>
  window.onload = function () {
    var button = document.getElementById('clickButton');
    button.click();
  }


  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      const output = document.getElementById('image-preview');
      output.src = reader.result;
      output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  }

</script><?php /**PATH /home/xgood/public_html/admin/resources/views/front/page/manual_gateway.blade.php ENDPATH**/ ?>