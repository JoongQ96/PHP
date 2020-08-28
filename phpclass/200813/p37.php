<?php
function __autoload($class_name){
    include $class_name. ".php";
}

$obj = new test();
$obj->prt();

$obj2 = new igomoya();
$obj2->prt();
?>