<?php
class CM {
    private static $classValue  = "class member value";
    private        $memberValue = "instance member value";

    public static function printClassValue(){
        echo CM::$classValue."<br>";
    }
    public function printMemberValue(){
        echo $this->memberValue."<br>";
    }
}
CM::printClassValue();

$objA = new CM();
$objA->printMemberValue();
?>



