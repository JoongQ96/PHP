<?php
class CIR {
    private static $age  = 38;
    private        $name = "정영철";

    public static function printName() {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
//        echo $this->name."<br>";
    }

    public function printAge() {
        echo CIR::$age."<br>";
    }

    public static function printInfo() {
        CIR::printName();
//        $this->printAge();
    }
}

CIR::printInfo();

$objA = new CIR();
$objA->printInfo();
?>

