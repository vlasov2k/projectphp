<?php
include 'classes/demo.php';

class DemoTest extends \PHPUnit\Framework\TestCase
{
    public $demo;
    protected function setUp(): void
    {
        $this->demo = new Demo ();
    }
    public function testSum()
    {
        $this->assertEquals (4, $this->demo->sum (2,2));
        $this->assertNotEquals (3, $this->demo->sum (1,1));
    }
    public function testSubstract()
    {
        $this->assertEquals (2, $this->demo->substract (4,2));
        $this->assertNotEquals (3, $this->demo->substract (1,1));
    }
}
