<?php
class ClassA{
    function __construct(){
        print "Class A's constructor is invoked"."<br>";
    }
}
class ClassB extends ClassA{
    function __construct(){
        print "Class B's constructor is invoked"."<br>";
    }
}

$obj = new ClassB();
// 상속 시 부모 클래스의 생성자는 자동으로 호출 되지 않는다.
?>





