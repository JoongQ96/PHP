<?php
class A {
    private   $privateValue   = 30;
    protected $protectedValue = 31;
    public    $publicValue    = 32;
}

class B extends A {
    function test() {
        echo $this->protectedValue."<br>";
    }
}

$objA = new A();
$objB = new B();

//echo $objA->privateValue."<br>";
//echo $objA->protectedValue."<br>";
echo $objA->publicValue."<br>";

//echo $objB->privateValue."<br>";
//echo $objB->protectedValue."<br>";
echo $objB->publicValue."<br>";




