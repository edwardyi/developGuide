<?php

/**
 * MpgPayFormBuilder
 * 
 */
class MpgPayFormBuilder
{
	const NO_LOGIN = 0;
	const MUST_LOGIN = 1;
	const MERCHANTID = 'MS34929914';
	const DEFAULT_RESPOND_TYPE = 'JSON';
	const VERSION = '1.4';
	const HASHKEY = 'NHAJaz2dyjBYpAmgDarPqEbi6cqNKALZ';
	const HASHIV = 'ssWjalOnlFGpXge3';

	// FORM SETTING
	const FORM_POST_URL = 'https://ccore.spgateway.com/MPG/mpg_gateway';
	const CONFIRM_BTN_NAME = '確認付款';

	// PAYMENT SETTING
	private $nowDate;
	private $email;
	private $amt;
	private $itemDesc;

	function __construct($payArray)
	{
		$this->nowDate = strtotime(gmdate("Y-m-d H:i:s", strtotime("+8 hours")));

		$this->email = $payArray['email'];
		$this->amt = $payArray['amt'];
		$this->itemDesc = $payArray['itemDesc'];
	}

	public function getDisplayHiddenFields($defaultPadding = 10)
	{
		$tradeCode = $this->getTradeCode();
		$hiddenFields = array(
			'MerchantID' => self::MERCHANTID,
			'TradeInfo' => $tradeCode['info'],
			'TradeSha' => $tradeCode['sha'],
			'RespondType' => self::DEFAULT_RESPOND_TYPE,
			'Version' => self::VERSION,
			'TimeStamp' => $this->getTimeStamp(),
			'MerchantOrderNo' => $this->getMerchantOrderNo(),
			'Amt' => $this->amt,
			'ItemDesc' => $this->itemDesc,
			'Email' => $this->email,
			'LoginType' => self::NO_LOGIN,
			'HashKey' => self::HASHKEY,
			'HashIV' => self::HASHIV
		);
		$strHiddenFields = sprintf('<form method="post" action="%s">', self::FORM_POST_URL);
		foreach ($hiddenFields as $key => $value) {
			$strHiddenFields .= sprintf("<input type='hidden' name='%s' value='%s' />".chr($defaultPadding), $key, $value);
		}
		$strHiddenFields .= sprintf('<input type="submit" name="submit" value="%s" />', self::CONFIRM_BTN_NAME);
		$strHiddenFields .= '</form>';
		echo $strHiddenFields;
	}

	public function getTimeStamp()
	{
		return $this->nowDate;	
	}

	// 商店自訂訂單編號，限英、數字、”_ ”格式。
	public function getMerchantOrderNo()
	{
		return $this->nowDate.$this->amt;
	}

	public function getTradeCode()
	{	
		$tradeInfoArr = array(
			'MerchantID' => self::MERCHANTID,
			'RespondType' => self::DEFAULT_RESPOND_TYPE,
			'TimeStamp' => $this->getTimeStamp(),
			'Version' => self::VERSION,
			'MerchantOrderNo'=> $this->getMerchantOrderNo(),
			'Amt' => $this->amt,
			'ItemDesc' => $this->itemDesc
		);

		$tradeInfo = $this->createMpgAesEncrypt($tradeInfoArr, self::HASHKEY, self::HASHIV);
		$tradeSha = strtoupper(hash("sha256", sprintf("HashKey=%s&%s&HashIV=%s", self::HASHKEY, $tradeInfo, self::HASHIV)));

		return array(
			'info' => $tradeInfo, 
			'sha' => $tradeSha
		);
	}

	private function createMpgAesEncrypt($parameter="", $key="", $iv="") {
		$returnStr = "";
	  	if (!empty($parameter)) {
			$returnStr = http_build_query($parameter);
		}
		return trim(bin2hex(openssl_encrypt($this->addpadding($returnStr), 'aes-256-cbc', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv)));
	}
	private function addpadding($string, $blockSize = 32) {
		$len = strlen($string);
		$pad = $blockSize - ($len % $blockSize);
		$string .= str_repeat(chr($pad), $pad);
		return $string;
	}


}

?>