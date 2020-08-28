<?php
// p14
class A {
    static $cloned_count;

    function __clone() {
        echo "__clone() is invoked <br>";
        A::$cloned_count++;
    }

    function __construct(){
        echo A::$cloned_count."<br>";
    }
}

$obj = new A();

for($i = 0; $i < 5; $i++)
    $cobj[$i] = clone $obj;

echo A::$cloned_count;



