<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class OverloadingTest
{
    function test()
    {
        echo "test() is invoked <br>";
    }

    function test($arg1, $arg2)
    {
        echo " test({$arg1}, {$arg2}) is invoked <br>";
    }
}

$obj = new OverloadingTest();

$obj->test();
$obj->test(1, 2);


?>




