<?php
// SingleTone -> 객체를 단 한번만 찍는다.
class A
{
    // 외부에서 멤버에 접근할 수 없도록 private
    private static $ObjRef = null;

    // 생성자가 private 인 경우 new 연산자로 객체 생성불가
    private function __construct(){
        echo "A's constructor is invoked<br>";
    }

    // A 클래스의 객체를 반환하는 프로그램 작성
    // 단, A 클래스 객체는 단 하나만 만들 수 있다.
    // 언제 A 클래스의 객체를 생성할까? -> A 클래스의 객체가 한개도 생성되지 않았을 경우
    public function getObject(){
        if (self::$ObjRef == null) {
            // new 연사자로 객체를 생성할 수 있는 이유?
            // private -> 같은 클래스 내 or 상속인 경우에만 사용가능
            // private 생성자와 같은 영역이므로 생성 가능함!
            self::$ObjRef = new A();
        }
        return self::$ObjRef;
    }
    function printMyName(){
        echo __METHOD__."<br>";
    }
}
// 객체 생성 O
$obj = A::getObject();
$obj->printMyName();
// 객체 생성 X
$obj2 = A::getObject();
$obj2->printMyName();
// new 연산자 사용 불가
// $myObj = new A();





