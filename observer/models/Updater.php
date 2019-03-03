<?php
require_once "../models/IObserver.php";
class Updater implements \SplSubject
{
  private $action;
  private $observers;
  // 一個updater有多個observer

  public function __construct()
  {
    $this->observers = new \SplObjectStorage();
  }

  public function attach(\SplObserver $ob)
  {
    $this->observers->attach($ob);
  }

  public function detach(\SplObserver $ob)
  {
      $this->observers->detach($ob);
  }

  public function notify()
  {
    if ($this->observers) {
      foreach($this->observers as $observer) {
        $observer->update($this);
        echo 'notify updating...';
      }
    }
  }

  public function setAction($action)
  {
    $this->action = $action;
  }

  public function getAction()
  {
    return $this->action;
  }
}