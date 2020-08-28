<?php
class ClassA{
    function __construct(){
        print "Class A's constructor is invoked"."<br>";
    }
}

class ClassB extends ClassA{

}

$obj = new ClassB();
// 상송 클래스 내 생성자가 없을 경우 상위 클래스의 생성자 상속
?>



