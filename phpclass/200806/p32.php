<?php
class CIR {
    private static $age  = 38;
    private static $name = "정영철";

    public static function printName() {
        echo CIR::$name."<br>";
    }

    public function printAge() {
        echo CIR::$age."<br>";
    }

    public static function printInfo() {
        CIR::printName();
        CIR::printAge();
    }
}
?>




