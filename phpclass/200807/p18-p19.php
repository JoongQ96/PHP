<?php
// p18
class MyClass
{
    // 상수 선언
    const CONST_VALUE = 'A constant value';
}

$classname = 'MyClass';
echo $classname::CONST_VALUE;   // As of PHP 5.3.0
// 문자열 변수를 이용
// "::" 결합하여 클래스 내 멤버 접근 가능

echo MyClass::CONST_VALUE;

// p19

class OtherClass extends MyClass
{
    // 클래스 멤버변수 선언
    public static $my_static = 'static var';

    public static function doubleColon() {
        echo parent::CONST_VALUE."\n";
        echo self::$my_static."\n";
        // self:: - 현재 클래스(범위)를 지칭
    }
}

$classname = 'OtherClass';
echo $classname::doubleColon(); // As of PHP 5.3.0

OtherClass::doubleColon();





