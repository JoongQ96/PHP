<?php
function __autoload($class_name){
    echo "$class_name<br>";
}

$obj = new test();
$obj->prt();

$obj2 = new igomoya();
$obj2->prt();
?>