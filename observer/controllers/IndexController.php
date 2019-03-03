<?php
// views
require_once("../views/StoreWindow.php");
require_once("../views/ReportWindow.php");

// models(其實在views裡面有定義了)
require_once("../models/Customer.php");
require_once("../models/Store.php");

class IndexController
{
  private $storeWindow;
  private $reportWindow;
  private $viewStores;
  private $viewReports;
  private $modelCustomer;
  private $modelStore;

  public function __construct()
  {
    // Subject
    $this->modelCustomer = new Customer();
    $this->modelStore = new Store();
    
    // 取得view和view所需要的參數
    $this->storeWindow = new StoreWindow();
    $this->reportWindow = new ReportWindow();

    // attach
    $this->attach();

    $this->viewStores = $this->storeWindow->getStoreItems();
    $this->viewReports = $this->reportWindow->getReportItem();

    // 第一次載入頁面的時候決定要render到哪一頁去
    $this->action_switcher();
  }

  // observer attach
  public function attach()
  {
    // var_dump($this->modelCustomer);
      // attach
      $this->modelCustomer->attach($this->storeWindow);
      $this->modelCustomer->attach($this->reportWindow);
      $this->modelStore->attach($this->storeWindow);
      $this->modelStore->attach($this->reportWindow);    
  }

  // observer notify
  public function notify($action)
  {
      $this->modelCustomer->setAction($action);
      $this->modelStore->setAction($action);

      $this->modelCustomer->notify();
      $this->modelStore->notify();
  }

  // controller base function
  public function render($uri, $params = array())
  {
    // echo $uri;
    $stores = array();
    extract($params);
    ob_start();
    include($uri);
    $file = ob_get_clean();
    echo $file;
  }

  // controller base function
  public function is_ajax()
  {
    if(!empty($_SERVER['CONTENT_TYPE']) && strtolower($_SERVER['CONTENT_TYPE']) == 'application/x-www-form-urlencoded') {
      /* special ajax here */
      // echo 'this is ajax';
      return true;
      // die('test ajax');
    }
    return false;
  }

  // controller base function
  public function action_switcher()
  {
    $action = 'store';
    if(!empty($_GET)) {
      $action = $_GET['action'];
    }
    // 用URL區別不同的action
    switch($action){
      case 'store':
        $this->store();
      break;
      case 'report':
        $this->report();
      break;
      case'getStoreList':
        $this->getStoreList();
      break;
      case 'addCustomerList':
        $this->addCustomerList();
      break;
      case 'getAjaxList':
        $this->getAjaxList();
      break;
      case 'reportReoveList':
        $this->reportReoveList();
      break;
      case 'reportBuyList':
        $this->reportBuyList();
      break;
    }
  }

  // ajax
  public function getAjaxList()
  {
    header("Content-type: application/json");
    echo json_encode($this->reportWindow->report());
  }

  // ajax
  public function getStoreList()
  {
    if(isset($_POST) && !empty($_POST)) {
      $storeList = $this->modelCustomer->getBuyStock($this->viewStores);
      echo json_encode($storeList);
    }
  }

  // ajax
  public function addCustomerList()
  {
    // var_dump($_POST);
    if(isset($_POST) && !empty($_POST)) {
      header("Content-type: application/json");
      $this->storeWindow->addItem($_POST);
      // nofity變化
      $this->notify(__FUNCTION__);
      echo 'success';
    }
  }

  // ajax
  public function reportReoveList()
  {
      if(isset($_POST) && !empty($_POST)) {
        $this->reportWindow->clearList();
        // nofity變化
        $this->notify(__FUNCTION__);
        echo 'success';
      }
  }

  // ajax
  public function reportBuyList()
  {
    if(isset($_POST) && !empty($_POST)) {
      echo 'ajax request update';
      $this->reportWindow->reportBuyList();
      // nofity變化
      $this->notify(__FUNCTION__);
      echo 'success';
    }
  }


  // storeWindow
  public function store()
  {
    $this->render('../web/StoreWindow.php', array('stores'=>$this->viewStores,'title'=>'Observer商城'));
  }
  

  // reportWindow
  public function report()
  {
    $this->render('../web/ReportWinow.php', array('customers'=>$this->reportWindow->report(),'title'=>'Observer商城-購物清單'));
  }
}

$index = new IndexController();