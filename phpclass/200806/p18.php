<?php
class PClass {
    private $name;
    private $age;

    function __construct($name, $age) {
        echo "PClass constructor is invoked<br>";

        $name = $name;  // 멤버 변수 호출방법 잘못됨, $this->name = $name
        $age  = $age;   // 멤버 변수 호출방법 잘못됨, $this->age  = $age
    }

    function printMyName() {
        echo "My name : ".$this->name."<br>";
    }

    function printMyAge() {
        echo "My age : ".$this->age."<br>";
    }

    function printMyInfo() {
        $this->printMyName();
        $this->printMyAge();
    }
}

$obj = new PClass("정영철", 18);
$obj->printMyInfo();
?>




