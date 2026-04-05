<?php
include("POM_config.php");

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date = date("Y-m-d", $timestamp);

$id      = $_POST['id'];
$number      = $_POST['number'];
// 1 = single digigt
if ($id == 1) {
	if ($number == '0') {
		$data = array('0');
	} elseif ($number == '1') {
		$data = array('1');
	} elseif ($number == '2') {
		$data = array('2');
	} elseif ($number == '3') {
		$data = array('3');
	} elseif ($number == '4') {
		$data = array('4');
	} elseif ($number == '5') {
		$data = array('5');
	} elseif ($number == '6') {
		$data = array('6');
	} elseif ($number == '7') {
		$data = array('7');
	} elseif ($number == '8') {
		$data = array('8');
	} elseif ($number == '9') {
		$data = array('9');
	} else {
		$data = array('');
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();

	// 2 jodi digit
} elseif ($id == 2) {
	if ($number == '0') {
		$data = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09');
	} elseif ($number == '1') {
		$data = array('10', '11', '12', '13', '14', '15', '16', '17', '18', '19');
	} elseif ($number == '2') {
		$data = array('20', '21', '22', '23', '24', '25', '26', '27', '28', '29');
	} elseif ($number == '3') {
		$data = array('30', '31', '32', '33', '34', '35', '36', '37', '38', '39');
	} elseif ($number == '4') {
		$data = array('40', '41', '42', '43', '44', '45', '46', '47', '48', '49');
	} elseif ($number == '5') {
		$data = array('50', '51', '52', '53', '54', '55', '56', '57', '58', '59');
	} elseif ($number == '6') {
		$data = array('60', '61', '62', '63', '64', '65', '66', '67', '68', '69');
	} elseif ($number == '7') {
		$data = array('70', '71', '72', '73', '74', '75', '76', '77', '78', '79');
	} elseif ($number == '8') {
		$data = array('80', '81', '82', '83', '84', '85', '86', '87', '88', '89');
	} elseif ($number == '9') {
		$data = array('90', '91', '92', '93', '94', '95', '96', '97', '98', '99');
	} else {
		$data = array($number);
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
	// 3 single pana
} elseif ($id == 3) {
	if ($number == 0) {
		$data = array('');
	} elseif ($number == 1) {
		$data = array('127', '136', '145', '190', '128', '137', '146', '129', '138', '147', '156', '120', '139', '148', '157', '130', '149', '158', '167', '140', '159', '168', '123', '150', '169', '178', '124', '160', '179', '125', '134', '170', '189', '126', '135', '180');
	} elseif ($number == 2) {

		$data = array('235', '280', '236', '245', '290', '237', '246', '238', '247', '256', '239', '248', '257', '230', '249', '258', '267', '240', '259', '268', '250', '269', '278', '260', '279', '234', '270', '289');
	} elseif ($number == 3) {
		$data = array('370', '389', '380', '345', '390', '346', '347', '356', '348', '357', '349', '358', '367', '340', '359', '368', '350', '369', '378', '360', '379');
	} elseif ($number == 4) {
		$data = array('479', '460', '470', '489', '480', '490', '456', '457', '458', '467', '459', '468', '450', '469', '478');
	} elseif ($number == 5) {
		$data = array('569', '578', '560', '579', '570', '589', '580', '590', '567', '568');
	} elseif ($number == 6) {
		$data = array('678', '679', '670', '689', '680', '690');
	} elseif ($number == 7) {
		$data = array('789', '780', '790');
	} elseif ($number == 8) {
		$data = array('890');
	} elseif ($number == 9) {
		$data = array('');
	} elseif ($number == 10) {
		$data = array('');
	} elseif ($number == 11) {
		$data = array('');
	} elseif ($number == 12) {
		$data = array('127', '128', '129', '120', '123', '124', '125', '126');
	} elseif ($number == 13) {
		$data = array('137', '138', '139', '130', '134', '135', '136');
	} elseif ($number == 14) {
		$data = array('145', '146', '147', '148', '149', '140');
	} elseif ($number == 15) {
		$data = array('156', '157', '158', '159', '150');
	} elseif ($number == 16) {
		$data = array('167', '168', '169', '160');
	} elseif ($number == 17) {
		$data = array('178', '179', '170');
	} elseif ($number == 18) {
		$data = array('189', '180');
	} elseif ($number == 19) {
		$data = array('190');
	} elseif ($number == 20 || $number == 21 || $number == 22) {
		$data = '';
	} elseif ($number == 23) {
		$data = array('235', '236', '237', '238', '239', '230');
	} elseif ($number == 24) {
		$data = array('245', '246', '247', '248', '249', '240');
	} elseif ($number == 25) {
		$data = array('256', '257', '258', '259', '250');
	} elseif ($number == 26) {
		$data = array('267', '268', '269', '260');
	} elseif ($number == 27) {
		$data = array('278', '279', '270');
	} elseif ($number == 28) {
		$data = array('289', '280');
	} elseif ($number == 29) {
		$data = array('290');
	} elseif ($number == 30 || $number == 31 || $number == 32 || $number == 33) {
		$data = array('');
	} elseif ($number == 34) {
		$data = array('345', '346', '347', '348', '349', '340');
	} elseif ($number == 35) {
		$data = array('356', '357', '358', '359', '350');
	} elseif ($number == 36) {
		$data = array('367', '368', '369', '360');
	} elseif ($number == 37) {
		$data = array('378', '379', '370');
	} elseif ($number == 38) {
		$data = array('389', '380');
	} elseif ($number == 39) {
		$data = array('390');
	} elseif ($number == 40 || $number == 41 || $number == 42 || $number == 43 || $number == 44) {
		$data = array('');
	} elseif ($number == 45) {
		$data = array('456', '457', '458', '459', '450');
	} elseif ($number == 46) {
		$data = array('467', '468', '469', '460');
	} elseif ($number == 47) {
		$data = array('478', '479', '470');
	} elseif ($number == 48) {
		$data = array('489', '480');
	} elseif ($number == 49) {
		$data = array('490');
	} elseif ($number == 50 || $number == 51 || $number == 52 || $number == 53 || $number == 54 || $number == 55) {
		$data = array('');
	} elseif ($number == 56) {
		$data = array('567', '568', '569', '560');
	} elseif ($number == 57) {
		$data = array('578', '579', '570');
	} elseif ($number == 58) {
		$data = array('589', '580');
	} elseif ($number == 59) {
		$data = array('590');
	} elseif ($number == 60 || $number == 61 || $number == 62 || $number == 63 || $number == 64 || $number == 65 || $number == 66) {
		$data = array('');
	} elseif ($number == 67) {
		$data = array('678', '679', '670');
	} elseif ($number == 68) {
		$data = array('689', '680');
	} elseif ($number == 69) {
		$data = array('690');
	} elseif ($number == 70 || $number == 71 || $number == 72 || $number == 73 || $number == 74 || $number == 75 || $number == 76 || $number == 77) {
		$data = array('');
	} elseif ($number == 78) {
		$data = array('789', '780');
	} elseif ($number == 79) {
		$data = array('790');
	} elseif ($number == 80 || $number == 81 || $number == 82 || $number == 83 || $number == 84 || $number == 85 || $number == 86 || $number == 87 || $number == 88) {
		$data = array('');
	} elseif ($number == 89) {
		$data = array('890');
	} elseif ($number == 120) {
		$data = array('120');
	} elseif ($number == 123) {
		$data = array('123');
	} elseif ($number == 124) {
		$data = array('124');
	} elseif ($number == 125) {
		$data = array('125');
	} elseif ($number == 126) {
		$data = array('126');
	} elseif ($number == 127) {
		$data = array('127');
	} elseif ($number == 128) {
		$data = array('128');
	} elseif ($number == 129) {
		$data = array('129');
	} elseif ($number == 130) {
		$data = array('130');
	} elseif ($number == 134) {
		$data = array('134');
	} elseif ($number == 135) {
		$data = array('135');
	} elseif ($number == 136) {
		$data = array('136');
	} elseif ($number == 137) {
		$data = array('137');
	} elseif ($number == 138) {
		$data = array('138');
	} elseif ($number == 139) {
		$data = array('139');
	} elseif ($number == 140) {
		$data = array('140');
	} elseif ($number == 145) {
		$data = array('145');
	} elseif ($number == 146) {
		$data = array('146');
	} elseif ($number == 147) {
		$data = array('147');
	} elseif ($number == 148) {
		$data = array('148');
	} elseif ($number == 149) {
		$data = array('149');
	} elseif ($number == 150) {
		$data = array('150');
	} elseif ($number == 156) {
		$data = array('156');
	} elseif ($number == 157) {
		$data = array('157');
	} elseif ($number == 158) {
		$data = array('158');
	} elseif ($number == 159) {
		$data = array('159');
	} elseif ($number == 160) {
		$data = array('160');
	} elseif ($number == 167) {
		$data = array('167');
	} elseif ($number == 168) {
		$data = array('168');
	} elseif ($number == 169) {
		$data = array('169');
	} elseif ($number == 170) {
		$data = array('170');
	} elseif ($number == 178) {
		$data = array('178');
	} elseif ($number == 179) {
		$data = array('179');
	} elseif ($number == 180) {
		$data = array('180');
	} elseif ($number == 189) {
		$data = array('189');
	} elseif ($number == 190) {
		$data = array('190');
	} else {
		$data = array('');
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
}
// 4 double pana
elseif ($id == 4) {
	if ($number == 0) {
		$data = array('');
	} elseif ($number == 1) {
		$data = array('118', '100', '119', '155', '110', '166', '112', '113', '122', '177', '114', '115', '133', '188', '116', '117', '144', '199', '112');
	} elseif ($number == 2) {
		$data = array('244', '299', '226', '227', '200', '228', '255', '229', '220', '266', '277', '223', '224', '233', '288', '225');
	} elseif ($number == 3) {
		$data = array('334', '335', '344', '399', '336', '300', '337', '355', '338', '339', '366', '330', '377', '388');
	} elseif ($number == 4) {
		$data = array('488', '499', '445', '400', '446', '455', '447', '448', '466', '449', '440', '477');
	} elseif ($number == 5) {
		$data = array('550', '588', '599', '500', '556', '557', '566', '558', '559', '577');
	} elseif ($number == 6) {
		$data = array('668', '677', '669', '660', '688', '699', '600', '667');
	} elseif ($number == 7) {
		$data = array('778', '779', '788', '770', '799', '700');
	} elseif ($number == 8) {
		$data = array('889', '880', '899', '800');
	} elseif ($number == 9) {
		$data = array('990', '900');
	} elseif ($number == 11) {
		$data = array('118', '119', '110',  '113', '114', '115',  '116', '117', '112');
	} elseif ($number == 12 || $number == 122) {
		$data = array('122');
	} elseif ($number == 13 || $number == 133) {
		$data = array('133');
	} elseif ($number == 14 || $number == 144) {
		$data = array('144');
	} elseif ($number == 15 || $number == 155) {
		$data = array('155');
	} elseif ($number == 16 || $number == 166) {
		$data = array('166');
	} elseif ($number == 17 || $number == 177) {
		$data = array('177');
	} elseif ($number == 18 || $number == 188) {
		$data = array('188');
	} elseif ($number == 19 || $number == 199) {
		$data = array('199');
	} elseif ($number == 20 || $number == 200) {
		$data = array('200');
	} elseif ($number == 22) {
		$data = array('226', '227', '228', '229', '220', '223', '224', '225');
	} elseif ($number == 23 || $number == 233) {
		$data = array('233');
	} elseif ($number == 24 || $number == 244) {
		$data = array('244');
	} elseif ($number == 25 || $number == 255) {
		$data = array('255');
	} elseif ($number == 26 || $number == 266) {
		$data = array('266');
	} elseif ($number == 27 || $number == 277) {
		$data = array('277');
	} elseif ($number == 28 || $number == 288) {
		$data = array('288');
	} elseif ($number == 29 || $number == 299) {
		$data = array('299');
	} elseif ($number == 30 || $number == 300) {
		$data = array('300');
	} elseif ($number == 33) {
		$data = array('334', '335', '336', '337',  '338', '339',  '330');
	} elseif ($number == 34 || $number == 344) {
		$data = array('334');
	} elseif ($number == 35 || $number == 355) {
		$data = array('355');
	} elseif ($number == 36 || $number == 366) {
		$data = array('366');
	} elseif ($number == 37 || $number == 377) {
		$data = array('377');
	} elseif ($number == 38 || $number == 388) {
		$data = array('388');
	} elseif ($number == 39 || $number == 399) {
		$data = array('399');
	} elseif ($number == 40 || $number == 400) {
		$data = array('400');
	} elseif ($number == 44) {
		$data = array('445', '446', '447', '448',  '449', '440');
	} elseif ($number == 45 || $number == 455) {
		$data = array('455');
	} elseif ($number == 46 || $number == 466) {
		$data = array('466');
	} elseif ($number == 47 || $number == 477) {
		$data = array('477');
	} elseif ($number == 48 || $number == 488) {
		$data = array('488');
	} elseif ($number == 49 || $number == 499) {
		$data = array('499');
	} elseif ($number == 50 || $number == 500) {
		$data = array('500');
	} elseif ($number == 55) {
		$data = array('550', '556', '557',  '558', '559');
	} elseif ($number == 56 || $number == 566) {
		$data = array('566');
	} elseif ($number == 57 || $number == 577) {
		$data = array('577');
	} elseif ($number == 58 || $number == 588) {
		$data = array('588');
	} elseif ($number == 59 || $number == 599) {
		$data = array('599');
	} elseif ($number == 60 || $number == 600) {
		$data = array('600');
	} elseif ($number == 66) {
		$data = array('660', '667',  '668', '669');
	} elseif ($number == 67 || $number == 677) {
		$data = array('677');
	} elseif ($number == 68 || $number == 688) {
		$data = array('688');
	} elseif ($number == 69 || $number == 699) {
		$data = array('699');
	} elseif ($number == 70 || $number == 700) {
		$data = array('700');
	} elseif ($number == 77) {
		$data = array('770', '778', '779');
	} elseif ($number == 78 || $number == 788) {
		$data = array('788');
	} elseif ($number == 79 || $number == 799) {
		$data = array('799');
	} elseif ($number == 80 || $number == 800) {
		$data = array('800');
	} elseif ($number == 88) {
		$data = array('880', '889');
	} elseif ($number == 89 || $number == 899) {
		$data = array('899');
	} elseif ($number == 90 || $number == 900) {
		$data = array('900');
	} elseif ($number == 99 || $number == 990) {
		$data = array('990');
	} else {
		$data = array('');
	}

	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
}
// 5 triple pana
elseif ($id == 5) {
	if ($number == '0' || $number == '00' || $number == '000') {
		$data = array('000');
	} elseif ($number == '1' || $number == '11' || $number == '111') {
		$data = array('111');
	} elseif ($number == '2' || $number == '22' || $number == '222') {
		$data = array('222');
	} elseif ($number == '3' || $number == '33' || $number == '333') {
		$data = array('333');
	} elseif ($number == '4' || $number == '44' || $number == '444') {
		$data = array('444');
	} elseif ($number == '5' || $number == '55' || $number == '555') {
		$data = array('555');
	} elseif ($number == '6' || $number == '66' || $number == '666') {
		$data = array('666');
	} elseif ($number == '7' || $number == '77' || $number == '777') {
		$data = array('777');
	} elseif ($number == '8' || $number == '88' || $number == '888') {
		$data = array('888');
	} elseif ($number == '9' || $number == '99' || $number == '999') {
		$data = array('999');
	} else {
		$data = array('');
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
}
// 6 half sangam
elseif ($id == 6) {
	// for ($x = 166; $x <= 169; $x++) {
	// 	print_r("'$x'" . ',');
	// }
	if ($number == 0) {
		$data = array('000');
	} elseif ($number == 1) {
		$data = array('100', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120', '122', '123', '124', '125', '126', '127', '128', '129', '130', '133', '134', '135', '136', '137', '138', '139', '140', '144', '145', '146', '147', '148', '149', '150',  '155', '156', '157', '158', '159', '160',  '166', '167', '168', '169', '170', '177', '178', '179', '180',  '188', '189', '190', '199');
	} elseif ($number == 2) {
		$data = array('200', '220', '222', '223', '224', '225', '226', '227', '228', '229', '230', '233', '234', '235', '236', '237', '238', '239', '240', '244', '245', '246', '247', '248', '249', '250', '255', '256', '257', '258', '259', '260', '266', '267', '268', '269', '270', '277', '278', '279', '280', '288', '289', '290', '299');
	} elseif ($number == 3) {
		$data = array('300',  '330', '333', '334', '335', '336', '337', '338', '339', '340', '345', '346', '347', '348', '349', '350', '355', '356', '357', '358', '359', '360', '366', '367', '368', '369', '370', '377', '378', '379', '380', '388', '389', '390', '399');
	} elseif ($number == 4) {
		$data = array('400', '440', '444', '445', '446', '447', '448', '449', '450', '455', '456', '457', '458', '459', '460',  '466', '467', '468', '469', '470', '477', '478', '479', '480', '488', '489', '490', '499');
	} elseif ($number == 5) {
		$data = array('500', '550', '555', '556', '557', '558', '559', '560', '566', '567', '568', '569', '570',  '577', '578', '579', '580', '588', '589', '590', '599');
	} elseif ($number == 6) {
		$data = array('600', '660', '666', '667', '668', '669', '670', '677', '678', '679', '680', '688', '689', '690', '699');
	} elseif ($number == 7) {
		$data = array('700', '770', '777', '778', '779', '780', '788', '789', '790', '799');
	} elseif ($number == 8) {
		$data = array('800', '880', '888', '889', '890', '899');
	} elseif ($number == 9) {
		$data = array('900', '990', '999');
	} elseif ($number == 10) {
		$data = array('100');
	} elseif ($number == 11) {
		$data = array('110', '111', '112', '113', '114', '115', '116', '117', '118', '119');
	} elseif ($number == 12) {
		$data = array('120', '122', '123', '124', '125', '126', '127', '128', '129');
	} elseif ($number == 13) {
		$data = array('130', '133', '134', '135', '136', '137', '138', '139');
	} elseif ($number == 14) {
		$data = array('140', '144', '145', '146', '147', '148', '149');
	} elseif ($number == 15) {
		$data = array('150', '155', '156', '157', '158', '159');
	} elseif ($number == 16) {
		$data = array('160', '166', '167', '168', '169');
	} elseif ($number == 17) {
		$data = array('170', '177', '178', '179');
	} elseif ($number == 18) {
		$data = array('180', '188', '189');
	} elseif ($number == 19) {
		$data = array('190', '199');
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
} elseif ($id == 7) {
	// for ($x = 166; $x <= 169; $x++) {
	// 	print_r("'$x'" . ',');
	// }
	if ($number == 0) {
		$data = array('000');
	} elseif ($number == 1) {
		$data = array('100', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120', '122', '123', '124', '125', '126', '127', '128', '129', '130', '133', '134', '135', '136', '137', '138', '139', '140', '144', '145', '146', '147', '148', '149', '150',  '155', '156', '157', '158', '159', '160',  '166', '167', '168', '169', '170', '177', '178', '179', '180',  '188', '189', '190', '199');
	} elseif ($number == 2) {
		$data = array('200', '220', '222', '223', '224', '225', '226', '227', '228', '229', '230', '233', '234', '235', '236', '237', '238', '239', '240', '244', '245', '246', '247', '248', '249', '250', '255', '256', '257', '258', '259', '260', '266', '267', '268', '269', '270', '277', '278', '279', '280', '288', '289', '290', '299');
	} elseif ($number == 3) {
		$data = array('300',  '330', '333', '334', '335', '336', '337', '338', '339', '340', '345', '346', '347', '348', '349', '350', '355', '356', '357', '358', '359', '360', '366', '367', '368', '369', '370', '377', '378', '379', '380', '388', '389', '390', '399');
	} elseif ($number == 4) {
		$data = array('400', '440', '444', '445', '446', '447', '448', '449', '450', '455', '456', '457', '458', '459', '460',  '466', '467', '468', '469', '470', '477', '478', '479', '480', '488', '489', '490', '499');
	} elseif ($number == 5) {
		$data = array('500', '550', '555', '556', '557', '558', '559', '560', '566', '567', '568', '569', '570',  '577', '578', '579', '580', '588', '589', '590', '599');
	} elseif ($number == 6) {
		$data = array('600', '660', '666', '667', '668', '669', '670', '677', '678', '679', '680', '688', '689', '690', '699');
	} elseif ($number == 7) {
		$data = array('700', '770', '777', '778', '779', '780', '788', '789', '790', '799');
	} elseif ($number == 8) {
		$data = array('800', '880', '888', '889', '890', '899');
	} elseif ($number == 9) {
		$data = array('900', '990', '999');
	} elseif ($number == 10) {
		$data = array('100');
	} elseif ($number == 11) {
		$data = array('110', '111', '112', '113', '114', '115', '116', '117', '118', '119');
	} elseif ($number == 12) {
		$data = array('120', '122', '123', '124', '125', '126', '127', '128', '129');
	} elseif ($number == 13) {
		$data = array('130', '133', '134', '135', '136', '137', '138', '139');
	} elseif ($number == 14) {
		$data = array('140', '144', '145', '146', '147', '148', '149');
	} elseif ($number == 15) {
		$data = array('150', '155', '156', '157', '158', '159');
	} elseif ($number == 16) {
		$data = array('160', '166', '167', '168', '169');
	} elseif ($number == 17) {
		$data = array('170', '177', '178', '179');
	} elseif ($number == 18) {
		$data = array('180', '188', '189');
	} elseif ($number == 19) {
		$data = array('190', '199');
	}
	$rows['success'] = $data;
	$rows['message'] = "success";
	echo (json_encode($rows));
	$conn->close();
}
