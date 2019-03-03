<?php
session_start();
require_once "../models/IObserver.php";
require_once "../models/Customer.php";
require_once "../models/Store.php";

class StoreWindow implements \SplObserver
{
  // 商品清單
  protected $store;
  // 購物清單
  protected $customer;

  public function __construct()
  {
    $this->store = new store();
    $this->customer = new Customer();
  }

  public function update(\SplSubject $subject): void
  {
    switch($subject->getAction()){
      case "addCustomerList":
        $this->JSScript = sprintf('onGetCustomerList();');
      break;
    }
  }

  public function getStoreItems()
  {
    return $this->store->getList();
  }

  public function addItem($item)
  {
    // 增加購物清單
    $this->customer->addItem($item);
  }

  public function getCustomerList()
  {
    return $this->customer->getList();
  }
}


?>