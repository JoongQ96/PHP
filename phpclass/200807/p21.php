<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
class A{
    public function test() {
        // $this 이용하여 인스턴스 멤버변수 접근
        echo $this->i_v."<br>";
        // self::를 이용하여 상수 c_v 접근
        echo self::c_v."<br>";
    }
}
class B extends A {
    public $i_v = "bar";
    const   c_v = "foo";
}

$obj1 = new B();
$obj1->test();

?>





