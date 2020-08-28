<?php
class A {
    function printMyName(){
        echo __CLASS__;
    }
}
class B extends A {
    function printMyName(){
        echo __CLASS__;
    }
}
class C extends A{
    // 접근제어자는 부모와 같거나 커야 한다
    protected function printMyName() {
        echo __CLASS__;
    }
}

$objB = new B();
$objB->printMyName();

$objC = new C();
$objC->printMyName();



