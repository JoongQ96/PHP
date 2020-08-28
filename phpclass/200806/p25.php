<?php
class A{

    public static $myName = "멋쟁이 초리~";
    private       $myAge  = "38";

    static public function printMyName() {
        echo self::$myName."<br>";
    }

    public function printMyAge() {
        echo $this->MyAge."<br>";
    }
}

A::printMyName();

$objB = new A();
$objB->printMyAge();
?>





