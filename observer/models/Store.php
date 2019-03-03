<?php
// require_once "Updater.php";
Class Store extends Updater 
{
  private $observers;
  // 有多個商品清單
  protected $items = array();

  public function __construct()
  {
    // echo "this is a Store";
    $this->initData();
    // 避免重複寫code，如果不加上去的話，沒有辦法建立SplObjectStorage
    parent::__construct();
    // $this->observers = new \SplObjectStorage();
  }


  public function initData()
  {
    // 商品清單，考量到有可能新增或刪除商品，多增加id的屬性，對應到商品資料
    $this->addItem(array("id"=>1,"name"=>"蘋果","price"=>100,"stock"=>300));
    $this->addItem(array("id"=>2,"name"=>"香蕉","price"=>150,"stock"=>340));
    $this->addItem(array("id"=>3,"name"=>"巴辣","price"=>200,"stock"=>600));
  }

  public function addItem($item)
  {
    array_push($this->items, $item);
    $this->notify();
  }

  public function removeItem($id)
  {
    foreach($this->items as $key => $item) {
      if($item['id'] == $id) {
        unset($this->items[$key]);
      }
    }
  }

  public function getList()
  {
    return $this->items;
  }

}

// $store = new Store();
// $tt = $store->getList();
// var_dump($tt);