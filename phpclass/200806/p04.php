<?php
class MyFirstClass
{
    // 멤버변수(속성:property) 선언
    private $name;

    // 생성자 선언
    function __construct($argName)
    {
        $this->name = $argName;
    }

    // 메소드 선언
    function printMyname(){
        echo $this->name;
    }
}

// MyFirstClass의 객체 생성
$mfc = new MyFirstClass("정영철");

// 생성된 객체의 "printMyName" 메소드 호출
$mfc->printMyname();
?>




