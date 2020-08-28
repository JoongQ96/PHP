<?php
class ClassA {
//    function __construct(){
//        print "Class A's constructor is invoked"."<br>";
//    }

    function ClassA(){
        print "ClassA() is used as a constructor"."<br>";
    }
}

$obj = new ClassA();
// 클래스 내 생성자가 없을 경우, 이전 버전과의 호환성 문제를 해결하기 위해
// 클래스 이름과 같은 메소드를 찾고 이를 생성자로 실행한다.
?>




