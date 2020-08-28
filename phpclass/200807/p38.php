<?php


class OverloadingTest{
    function __set($name, $arg){
        print $name . " : " . $arg . "<br>";
    }

    function __get($name){
        print $name . "<br>";
    }

    function __isset($name){  // As of 5.1.0
        print "__isset() -> " . $name . "<br>";
        return true;
    }
    function __unset($name){ // As of 5.1.0
        print "__unset() -> " . $name . "<br>";
        return true;
    }
}
$obj = new OverloadingTest();
$obj->test = 18;
$var_a = $obj->opnet;

isset($obj->test);
unset($obj->opnet);



?>

