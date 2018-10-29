<?php
// 用namespace把Foo用到的time重新定義過
// 注意:如果使用use關鍵字的話會有重複定義的問題
namespace App\Libraries;
function time() {
    return 'stud';
}

class FooTest extends \PHPUnit\Framework\TestCase {
    public function setUp() {
        
    }
   
    public function testDynamicFooTime() {
        $this->assertEquals('stud', (new Foo)->go());
    }
}
