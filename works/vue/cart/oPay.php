<?php
// https://www.opay.tw/Content/files/O_Pay_047.pdf
$returnURL = 'https://edwardyi.github.io';
$hashKey = '5294y06JbISpM5x9';
$hashIV = 'v77hoKGq4kWxNNIS';
$merchantID = '2000132';
$merchantTradeNo = '';
$nowDate = gmdate("Y-m-d H:i:s", strtotime("+8 hours"));
$merchantTradeDate = strtotime($nowDate);
$totalAmount = '1700';
$tradeDesc = "【香格里拉台南遠東國際大飯店-大廳茶軒】經典早午餐單人饗宴";
$items = "【香格里拉台南遠東國際大飯店-大廳茶軒】";
$name = "經典早午餐單人饗宴";
$price = "170";
$currency = "元";
$quantity = "10";

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="https://payment-stage.opay.tw/Cashier/AioCheckOut/V2">
		<input type="hidden" name="ReturnURL" value="<?php echo $returnURL;?>">
		<input type="hidden" name="HashKey" value="<?php echo $hashKey;?>">
		<input type="hidden" name="HashIV" value="<?php echo $hashIV;?>">
		<input type="hidden" name="MerchantID" value="<?php echo $merchantID;?>">
		<input type="hidden" name="MerchantTradeNo" value="<?php echo $merchantTradeNo;?>">
		<input type="hidden" name="MerchantTradeDate" value="<?php echo $merchantTradeDate;?>">
		<input type="hidden" name="TotalAmount" value="<?php echo $totalAmount;?>">
		<input type="hidden" name="TradeDesc" value="<?php echo $tradeDesc;?>">
		<input type="hidden" name="Items" value="<?php echo $items;?>">
		<input type="hidden" name="Name" value="<?php echo $name;?>">
		<input type="hidden" name="Price" value="<?php echo $price;?>">
		<input type="hidden" name="Currency" value="<?php echo $currency;?>">
		<input type="hidden" name="Quantity" value="<?php echo $quantity;?>">
	</form>
</body>
</html>


