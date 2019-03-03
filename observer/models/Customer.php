<?php
require_once "Updater.php";
Class Customer extends Updater
{
  // 是否以結帳
  protected $isBuy = false;

  // 有多個商品清單
  protected $items = array();

  public function __construct()
  {
    // echo "this is a Customer";
    parent::__construct();
    // echo 'customer reinit';
  }

  public function report($viewStores)
  {
    $customerList = $this->getList();
    $result = array();
    if ($viewStores && $customerList) {
      foreach ($viewStores as $k=>$v) {
        if(array_key_exists($v['id'],$customerList)) {
          $v['total_price'] = $customerList[$v['id']]['amount'] * $v['price'];
          $result[] = array_merge($customerList[$v['id']],$v);
        }
      }
    }
    return $result;
  }

  public function getBuyStock($viewStores)
  {
    $customerList = $this->getList();
    $result = array();
    if ($viewStores && $customerList) {
      foreach ($viewStores as $k=>$v) {
        if(array_key_exists($v['id'],$customerList)) {
          $amount = (int)$customerList[$v['id']]['amount'];
          (int)$v['stock'] -= $amount;
          $v['total_price'] = $amount * $v['price'];
          $result[] = array_merge($customerList[$v['id']],$v);
        }
      }
    }
    return $result;
  }

  public function addItem($item)
  {
    if (!$_SESSION['customer_id']) {
      $_SESSION['customer_id'] = array();
    }
    $_SESSION['customer_id'][$item['id']] = $item;
    $this->notify();
  }

  public function getList()
  {
    if (isset($_SESSION['customer_id'])) {
      return $_SESSION['customer_id'];
    }
  }

  public function clearList()
  {
    if ($_SESSION) {
      unset($_SESSION['customer_id']);
    }
  }

  public function setBuyIt()
  {
    $this->isBuy = true;
    // $this->notify();
  }

  public function getBuyIt()
  {
    return $this->isBuy;
  }
}