<?php

class A {
    public $i_v = "i_v 1";
    const c_v   = "c_v 1";
    static $s_v = "s_v 1";

    public function test() {
        echo $this->i_v."<br>";
        echo self::$s_v."<br>";
    }
}
class B extends A {
    public $i_v = "i_v 2";
    const   c_v = "c_v 2";
    static $s_v = "s_v 2";

    function ycj() {
        echo self::$s_v."<br>";
        parent::test();
        // 부모의 인스턴스 멤버 메소드 호출
        // 메소드의 경우 인스턴스 메소드도
        // "::" 연산자를 이요하여 호출 가능하다.
    }
}

$b = new B();
$b->ycj();






