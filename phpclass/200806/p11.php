<?php
class ClassA{
    function __construct(){
        print "Class A's constructor is invoked"."<br>";
    }
}
class ClassB extends ClassA {
    function __construct(){
        parent::__construct();
        print "Class B's constructor is invoked"."<br>";
    }
}

$obj = new ClassB();
// 상위 클래스의 상속자 호출시 "parent::" 키워드 사용
?>



