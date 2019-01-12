<?php

class CalculatorTest extends PHPUnit\Framework\TestCase{
    
    // 建立一次物件
    public function setUp(){
        $this->calculator = new \App\Libraries\Calculator();
    }
    
    //method1 簡單模式
    public function testAddTwoNumbersSimple()
    {
        $this->assertEquals(4, $this->calculator->add(2,2));
    }
    //method2 用陣列表示
    public function testAddTwoNumberWithArray()
    {
        $testValue = [
            [2,2,4],
            [2.5,2.5,5],
            [-3,9,6]
        ];
        foreach($testValue as $val) {
            $this->assertEquals($val[2], $this->calculator->add($val[0], $val[1]));
        }
    }
    
    // method 3 把資料抽離出來
    public function inputNumbers()
    {
        return [
            [2,2,4],
            [2.5,2.5,5],
            [-3,9,6]
        ];
    }
    
    /**
     * @dataProvider inputNumbers
     */
    public function testAddTwoNumbersWithDataProvider($x, $y, $sum)
    {
        $this->assertEquals($sum, $this->calculator->add($x, $y));
       
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddInvalidArgumentThrowExceptionIsPassed() {
        $calc = new \App\Libraries\Calculator();
        $calc->add('a', []);
    }
}
