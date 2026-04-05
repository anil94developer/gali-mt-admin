<?php
include("POM_config.php");

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
$date_zoon = date("H:i", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$current_time = date("h:i", $timestamp);
$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600;
$app_id = $_POST['app_id'];
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$device_id = $_POST['device_id'];
$type = $_POST['type'];
    $otp = $_POST['otp'] ?? '';
// echo "<pre>";
// print_r($paytm_number . "<br>" . $google_pay . "<br>" . $phone_pay . "<br>" . $account_number . "<br>" . $bank_name . "<br>" . $ifsc_code . "<br>" . $account_holder_name . "<br>" . $userId);
// echo "</pre>";
// die;

$withdraw_setting = mysqli_query($conn, "SELECT * FROM app_controller");
$withdraw = mysqli_fetch_assoc($withdraw_setting);

if ($date_zoon >= $withdraw['withdraw_open_time'] && $date_zoon <= $withdraw['withdraw_close_time']) {

    $min_withdraw = mysqli_query($conn, "SELECT min_redeem FROM app_controller");
    $row1 = mysqli_fetch_assoc($min_withdraw);

    if ($amount < $row1['min_redeem']) {
        $rows['success'] = '4';
        $rows['message'] = "Min Limit Withdraw Amount " . $row1['min_redeem'];
        echo (json_encode($rows));
        $conn->close();
        exit;
    }

    $sqlq = mysqli_query($conn, "SELECT win_amount,mob FROM us_reg_tbl WHERE user_id ='" . $user_id . "' AND app_id = '" . $app_id . "'");
    $row = mysqli_fetch_assoc($sqlq);
    $balance = $row['win_amount'];

    if ($balance < $amount) {
        $rows['success'] = '1';
        $rows['message'] = "You don't Have sufficient Balance";
        echo (json_encode($rows));
        exit;
    }

    $chk_user_withdraw = mysqli_query($conn, "SELECT * FROM point_table WHERE user_id ='" . $user_id . "' AND app_id = '" . $app_id . "' AND tr_nature = 'TRWITH003' AND date = '" .$date. "'");
    $count_chk_user_withdraw = mysqli_num_rows($chk_user_withdraw);

    
    if($count_chk_user_withdraw > 1){
        $rows['success'] = '2';
        $rows['message'] = "One Day On 2 Time Withdraw Only.";
        echo (json_encode($rows));
        $conn->close();
        exit;
    }


    $chk_user = mysqli_query($conn, "SELECT * FROM bank_details WHERE userId ='" . $user_id . "'");
    $row_chk_user = mysqli_fetch_assoc($chk_user);
    $count_chk_user = mysqli_num_rows($chk_user);
    $account_no = $row_chk_user['account_number'];
    $google_pay = $row_chk_user['google_pay'];
    $paytm_number = $row_chk_user['paytm_number'];
    $phone_pay = $row_chk_user['phone_pay'];
    if ($count_chk_user > 0) {
        if ($type == 'bank') {
            if (empty($row_chk_user['account_number']) || empty($row_chk_user['bank_name']) || empty($row_chk_user['ifsc_code']) || empty($row_chk_user['account_holder_name'])) {
                $rows['success'] = '2';
                $rows['message'] = "Bank Detail is Empty";
                echo (json_encode($rows));
                $conn->close();
                exit;
            } else {
                $bank_detail = '<strong>Tranfer By Bank  </strong><strong>Account Number</strong>' . ' ' . $row_chk_user['account_number'] . ' ' . '<strong>Ifsc Code</strong>' . ' ' . $row_chk_user['ifsc_code'];
            }
        } elseif ($type == 'googlepay') {
            if (empty($row_chk_user['google_pay'])) {
                $rows['success'] = '2';
                $rows['message'] = "Bank Detail is Empty";
                echo (json_encode($rows));
                $conn->close();
                exit;
            } else {
                $bank_detail = '<strong> Tranfer By GooglePay  GooglePay Number is </strong>' . $row_chk_user['google_pay'];
            }
        } elseif ($type == 'paytm') {
            if (empty($row_chk_user['paytm_number'])) {
                $rows['success'] = '2';
                $rows['message'] = "Bank Detail is Empty";
                echo (json_encode($rows));
                $conn->close();
                exit;
            } else {
                $bank_detail = '<strong> Tranfer By Paytm  Paytm Number is </strong>' . $row_chk_user['paytm_number'];
            }
        } elseif ($type == 'phonepay') {
            if (empty($row_chk_user['phone_pay'])) {
                $rows['success'] = '2';
                $rows['message'] = "Bank Detail is Empty";
                echo (json_encode($rows));
                $conn->close();
                exit;
            } else {
                $bank_detail = '<strong> Tranfer By PhonePay  PhonePay Number is </strong>' . $row_chk_user['phone_pay'];
            }
        }
    } else {
        $rows['success'] = '2';
        $rows['message'] = "Bank Detail is Empty";
        echo (json_encode($rows));
        $conn->close();
        exit;
    }

    $transId = rand('000000', '999999');
    $update_balance = $balance - $amount;
    $datecc = date('d-m-Y');
    $dateccy = date('Y-m-d H:i:s');

    if($withdraw['withdraw_otp'] == 1){
        $mobileNum = $row['mob'];
        $sql2 = mysqli_query($conn, "SELECT * FROM us_temp WHERE mobile='" . $mobileNum . "'");
        $otpdata = mysqli_fetch_assoc($sql2);
        // print_r($otpdata);die;
        if ($otpdata['otp'] != $otp) {
            $rows['success'] = '2';
            $rows['message'] = "Invailid Otp!";
            echo (json_encode($rows));
            $conn->close();
            exit;
        }
    }


    if ($row_chk_user['google_pay']) {
        $divice_reg = "INSERT INTO `point_table`(`app_id`,  `user_id`,`transaction_id`,`tr_nature`,`tr_value`,`tr_value_updated`,`value_update_by`,`tr_value_type`,`tr_status`,`device_type`,`admin_key`,`tr_remark`,`date`,`date_time`,`account_no`) VALUES ('$app_id', '$user_id','$transId','TRWITH003','$amount','$update_balance','Withdraw','Debit','Pending','$device_id','ADMIN0001','$bank_detail','$datecc','$dateccy','$google_pay')";
        $conn->query($divice_reg);
    } elseif ($row_chk_user['paytm_number']) {
        $divice_reg = "INSERT INTO `point_table`(`app_id`,  `user_id`,`transaction_id`,`tr_nature`,`tr_value`,`tr_value_updated`,`value_update_by`,`tr_value_type`,`tr_status`,`device_type`,`admin_key`,`tr_remark`,`date`,`date_time`,`account_no`) VALUES ('$app_id', '$user_id','$transId','TRWITH003','$amount','$update_balance','Withdraw','Debit','Pending','$device_id','ADMIN0001','$bank_detail','$datecc','$dateccy','$paytm_number')";
        $conn->query($divice_reg);
    } elseif ($row_chk_user['phone_pay']) {
        $divice_reg = "INSERT INTO `point_table`(`app_id`,  `user_id`,`transaction_id`,`tr_nature`,`tr_value`,`tr_value_updated`,`value_update_by`,`tr_value_type`,`tr_status`,`device_type`,`admin_key`,`tr_remark`,`date`,`date_time`,`account_no`) VALUES ('$app_id', '$user_id','$transId','TRWITH003','$amount','$update_balance','Withdraw','Debit','Pending','$device_id','ADMIN0001','$bank_detail','$datecc','$dateccy','$phone_pay')";
        $conn->query($divice_reg);
    } else {
        $divice_reg = "INSERT INTO `point_table`(`app_id`,  `user_id`,`transaction_id`,`tr_nature`,`tr_value`,`tr_value_updated`,`value_update_by`,`tr_value_type`,`tr_status`,`device_type`,`admin_key`,`tr_remark`,`date`,`date_time`,`account_no`) VALUES ('$app_id', '$user_id','$transId','TRWITH003','$amount','$update_balance','Withdraw','Debit','Pending','$device_id','ADMIN0001','$bank_detail','$datecc','$dateccy','$account_no')";
        $conn->query($divice_reg);
    }

    $sql1 = "UPDATE us_reg_tbl SET win_amount='" . $update_balance . "' WHERE user_id ='" . $user_id . "'";
    $result = $conn->query($sql1);

    $rows['success'] = "3";
    $rows['message'] = "Withdraw Request added sucessfully";

    echo (json_encode($rows));
    $conn->close();
    exit;
} else {
    $rows['success'] = '4';
    $rows['message'] = "Sorry You can withdraw only " . ' ' . date("h:i A", strtotime($withdraw['withdraw_open_time'])) . ' to ' . date("h:i A", strtotime($withdraw['withdraw_close_time']));
    echo (json_encode($rows));
    exit;
}
