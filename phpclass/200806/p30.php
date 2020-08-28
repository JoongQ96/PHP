<?php
class CI{
    private static $classValue = 1;

    public static function printClassName(){
        echo __CLASS__."<br>";
    }

    public function printClassValue(){
        echo CI::$classValue."<br>";
    }

    public function increaseClassValue(){
        CI::$classValue++;
    }
}
CI::printClassName();

$objA = new CI();
$objB = new CI();

$objA->increaseClassValue();
$objB->printClassValue();
// 클래스 멤버변수(속성)의 실 메모리공간은
// 같은 자료형을 가지는 모든 객체들에 의해 공유된다.
?>



