<?php


class A {
    public $a;

    function set ($argA) {
        $this->a = $argA;
    }
}
$obj = new A();
$obj->set(2);
$obj->set(2.0);
$obj->set("Two");

?>







