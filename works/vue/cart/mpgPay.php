<?php
// 金流串接測試
// 統編60290612
// 身分證A129313916
//  帳號:123555
// 密碼:123456qwerty
// 公司電話: 03-3332222-33
// email: hertvtest@yopmail.com
// cellphone: 0910412012
// https://www.opay.tw/Content/files/O_Pay_047.pdf
include_once('MpgPayFormBuilder.php');

$nowDate = gmdate("Y-m-d H:i:s", strtotime("+8 hours"));
$nowDate = strtotime($nowDate);
$email = "test@test.com";
$loginType = "0";


$merchantID = 'MS34929914'; 
$respondType = "JSON";
$version = "1.4";
$itemDesc = "【香格里拉台南遠東國際大飯店-大廳茶軒】經典早午餐單人饗宴";
$amt = '1700';


$tradeInfoArr = array(
	'MerchantID' => $merchantID,
	'RespondType' => $respondType,
	'TimeStamp' => $nowDate,
	'Version' => $version,
	'MerchantOrderNo'=> $nowDate,
	'Amt' => $amt,
	'ItemDesc' => $itemDesc
);

$hashKey = 'NHAJaz2dyjBYpAmgDarPqEbi6cqNKALZ';
$hashIV = 'ssWjalOnlFGpXge3';

$tradeInfo = createMpgAesEncrypt($tradeInfoArr, $hashKey, $hashIV);
$tradeSha = strtoupper(hash("sha256", "HashKey=$hashKey&".$tradeInfo."&HashIV=$hashIV"));
$payArray = array(
				'email' => 'test@test.com',
				'amt' =>  $amt,
				'itemDesc' => $itemDesc
			);
$mpgPayFormBuilder = new MpgPayFormBuilder($payArray);

?>

<!DOCTYPE html>
<html>
<head>
	<title>智付通金流串接</title>
</head>
<body>
	<?php echo $mpgPayFormBuilder->getDisplayHiddenFields(); ?>
	<form method="post" action="https://ccore.spgateway.com/MPG/mpg_gateway">
		<input type="hidden" name="MerchantID" value="<?php echo $merchantID;?>">
		<input type="hidden" name="TradeInfo" value="<?php echo $tradeInfo;?>">
		<input type="hidden" name="TradeSha" value="<?php echo $tradeSha;?>">
		<input type="hidden" name="RespondType" value="<?php echo $respondType;?>">
		<input type="hidden" name="Version" value="<?php echo $version;?>">
		<input type="hidden" name="TimeStamp" value="<?php echo $nowDate;?>">
		<input type="hidden" name="MerchantOrderNo" value="<?php echo $nowDate; ?>">
		<input type="hidden" name="Amt" value="<?php echo $amt;?>">
		<input type="hidden" name="ItemDesc" value="<?php echo $itemDesc;?>">
		<input type="hidden" name="Email" value="<?php echo $email; ?>">
		<input type="hidden" name="LoginType" value="<?php echo $loginType; ?>">
		<input type="hidden" name="HashKey" value="<?php echo $hashKey;?>">
		<input type="hidden" name="HashIV" value="<?php echo $hashIV;?>">
		<input type="submit" name="submit" value="確認付款" />
	</form>
</body>
</html>

<?php

function createMpgAesEncrypt($parameter="", $key="", $iv="") {
	$returnStr = "";
  	if (!empty($parameter)) {
		$returnStr = http_build_query($parameter);
	}
	return trim(bin2hex(openssl_encrypt(addpadding($returnStr), 'aes-256-cbc', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv)));
}
function addpadding($string, $blockSize = 32) {
	$len = strlen($string);
	$pad = $blockSize - ($len % $blockSize);
	$string .= str_repeat(chr($pad), $pad);
	return $string;
}

?>


