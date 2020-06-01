<?php
//применение всех возможных шаблонных методов

    class ArrayTest extends \PHPUnit\Framework\TestCase
    {
        //в самом начале
        public static function setUpBeforeClass(): void
        {
            print __METHOD__ . "\n";
        }
        //перед каждым тестом
        protected function setUp(): void
        {
            print __METHOD__ . "\n";
        }
        //перед каждым assertion
        protected function assertPreConditions(): void
        {
            print __METHOD__ . "\n";
        }
        public function testOne ()
        {
            print __METHOD__ . "\n";
            $this->assertTrue (TRUE);
        }
        public function testTwo ()
        {
            print __METHOD__ . "\n";
            $this->assertTrue (FALSE);
        }
        //после каждого assertion
        protected function assertPostConditions(): void
        {
            print __METHOD__ . "\n";
        }
        //после каждого теста
        protected function tearDown(): void
        {
            print __METHOD__ . "\n";
        }
        //в самом конце
        public static function tearDownAfterClass(): void
        {
            print __METHOD__ . "\n";
        }
        //при проблеме
        protected function onNotSuccessfulTest(\Throwable $t): void
        {
            print __METHOD__ . "\n";
            throw $t;
        }
    }