<?php
// p13
class A
{
    private static $objRef = null;

    private function __construct()
    {
        echo "A's constructor is invoked";
    }

    static function getObject() {
        if(self::$objRef == null) {
            self::$objRef = new A();
        }
        return self::$objRef;
    }

    function printMyName() {
        echo __METHOD__."<br>";
    }
}

$objA = A::getObject();
$objA->printMyName();