<?php
class Visa
{
  public function visa_pay($amount)
  {
    echo 'paid by '. $amount .' visa';
  }
}

// 
interface PaymentInterface
{
  public function pay($amount);
}

class VisaAdapter implements PaymentInterface
{
  // 隔離變化，如果Visa的付款方式不一樣了，就直接改visa類別的方法就行了
  protected $visa;
  public function __construct($visa)
  {
    $this->visa = $visa;
  }

  public function pay($amount)
  {
    $this->visa->visa_pay($amount);
  }
}

// 沒有使用adapter的作法
// $visa = new Visa();
// $visa->pay(1500);

$visa = new VisaAdapter(new Visa());
$visa->pay(2000);


