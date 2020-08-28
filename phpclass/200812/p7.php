<?php
// p7
error_reporting(E_ALL);
ini_set("display_errors", 1);

abstract class A {
    abstract function getValue();
}

abstract class B extends A {

}

class C extends B {
    function getValue(){
        echo "Print GV";
    }
}

$obj = new C();
$obj->getValue();




