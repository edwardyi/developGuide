<?php
require_once "../models/IObserver.php";
require_once "../models/Customer.php";
require_once "../models/Store.php";

class ReportWindow implements \SplObserver
{
  protected $store;
  protected $customer;
  protected $JSScript;

  public function __construct()
  {
    // echo "this is a store windows";
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

  public function report()
  {
    return $this->customer->report($this->store->getList());
  }

  public function clearList()
  {
    $this->customer->clearList();
  }

  public function reportBuyList()
  {
    $this->customer->setBuyIt();
    $this->customer->notify();
    return $this->customer->getBuyIt();
  }

  // 實作updateView
  public function updateView()
  {
    $this->customer->update();
  }

  public function getReportItem()
  {
    return $this->customer->report($this->store->getList());
  }
}