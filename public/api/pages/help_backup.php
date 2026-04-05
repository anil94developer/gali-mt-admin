<?PHP
include('../config.php');
// $appControler = mysqli_query($conn,"SELECT whatsapp,call_enable,admin_contact_mob,move_msg,video_link_website,fb_link FROM app_controller WHERE app_id = '".$appId."'");
$appControler = mysqli_query($conn,"SELECT whatsapp,call_enable,admin_contact_mob,move_msg,video_link_website,video_link_withdraw,video_link_game,fb_link FROM app_controller");
$appControllerData = mysqli_fetch_assoc($appControler);

 ?>
<center><h1 style="font-size:18px;color:green">Dubai King HELP & SUPPORT💥 </h1></center>
<h2 style="font-size:15px">
🌟DARK MODE मै एप्लिकेशन यूज न करे<br>
🔥Min Deposit: Rs. 100🔥<br>
🔥Min Withdraw: Rs. 500🔥<br>
🔥रेट 10 के 900🔥<br>

<!--♻️DEPOSIT HELPLINE NO.👇<br>
🔥<span style='color:red'>WHATSAPP 6367529290</span>🔥<br>
♻️WITHDRAW HELPLINE NO.👇<br>
🔥<span style='color:red'>WHATSAPP 9351865037</span>🔥<br>-->

<!-- 🔥भरोसे का एक ही नाम🔥<br>
🙏बाबा जी खाईवाल🙏<br> -->
</h2>
<p style="font-size:15px;color:green">NOTE:- अगर आपको गेम खेलने मैं या अगर कोई भी समस्या होती है तो आप हमारे हेल्पलाइन नंबर पर कॉल कर सकते हैं</p>
<!--<a target="_blank" href="https://wa.me/+919100417723"><i class="my-float"><img src="images/ss.png"></i><span class="badge"></span></a>-->
<h2 style="font-size:15px;color:black;">
<p style="text-align:center;font-size:18px;border-bottom:1px green dotted">👽गेम कैसे खेलनी है जानिए👽</p>
<p style="color:red;">
🔥सभी गेम मैं 1 से 100 नंबर मैं से कोई एक नंबर आता है अगर आपने वही लगाया हुआ है तो आपको 90 गुणा पैसे मिलेंगे<br>
🔥जैसे आपने 15 पर 10 रुपए लगाए हैं किसी गेम मैं और उसमे 15 रिजल्ट आता है तो आपको 900 रुपए मिलेंगे<br>
🔥आप कितने भी नंबर लगा सकते हो बस आपका पास होना चाइए और पास होते ही पैसा आपके वॉलेट मैं आ जायेगा<br>
</p>
<p style="text-align:center;font-size:18px;border-bottom:1px green dotted">👇👽गेम खेलना सीखने के लिए Video आइकन पे क्लिक करें👽</p>
<!-- <a href="<?php echo $appControllerData['video_link_website']?>" style="margin-left:50%"><img src="./images/icons8-video.gif" height='40' width='40'></a> -->

<a href="<?= $appControllerData['video_link_website']?>" style="float:left;height:80px;width:70px">Deposit<br><img src="/images/154417864.webp" height='75' width='75'></a>

<a href="<?= $appControllerData['video_link_withdraw']?>" style="float:left;height:70px;width:70px">Withdraw<br><img src="./images/154417864.webp" height='75' width='75'></a>

<a href="<?= $appControllerData['video_link_game']?>" style="float:left;height:70px;width:100px">Game Play<br><img src="./images/154417864.webp" height='75' width='75'></a>

<a href="#" style="float:right;height:70px;width:100px;color:green;font-size:12px;text-decoration:none">चैट पर क्लिक करके हमसे सम्पर्क करे।</a>