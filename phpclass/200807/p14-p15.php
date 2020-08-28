<?php
class A {
    private   $privateValueA   = 'A18';
    protected $protectedValueA = 'A218';
    public    $publicValueA    = 'A21818';

    public function AMTest(A $argA, B $argB) {
        // A 클래스 멤버
        echo $argA->privateValueA."<br>";
        echo $argA->protectedValueA."<br>";
        echo $argA->publicValueA."<br>";
        // B 클래스 멤버
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        echo $argB->privateValueB."<br>";
        echo $argB->protectedValueB."<br>";
        echo $argB->publicValueB."<br>";
    }
}

class B extends A {
    private   $privateValueB   = 'B18';
    protected $protectedValueB = 'B218';
    public    $publicValueB    = 'B21818';
}

$objA1  = new A();
$objA2  = new A();
$objB   = new B();

$objA1->AMTest($objA2, $objB);



