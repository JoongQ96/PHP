<?php
class A {
    public $variable;

    function __construct($argValue){
        $this->variable = $argValue;
    }
}
$obj1 = new A(18);
$obj2 = new A(218);
$obj3 = new A(18);
$obj4 = $obj1;

if ($obj1 === $obj3)
    echo '$obj1 === $obj3 : true<br>';
else
    echo '$obj1 === $obj3 : false<br>';

if ($obj1 === $obj4)
    echo '$obj1 === $obj4 : true<br>';
else
    echo '$obj1 === $obj4 : false<br>';





