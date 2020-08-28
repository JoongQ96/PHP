<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


class OverloadingTest{

    public function __set($name, $arg){
        print $name . " : " . $arg . "<br>";
    }

    public function __get($name){
        print $name . "<br>";
    }

}
$obj = new OverloadingTest();
$obj->test = 18;

$var_a = $obj->opnet;
?>



