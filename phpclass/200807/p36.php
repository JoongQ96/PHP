<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class OverloadingTest{

}
$obj = new OverloadingTest();
$obj->test = 18;

$var_a = $obj->opnet;



?>





