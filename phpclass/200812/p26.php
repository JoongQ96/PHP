<?php

trait A {
    public function smallTalk(){
        echo 'a';
    }

    public function bigTalk(){
        echo 'A';
    }
}

trait B {
    public function smallTalk(){
        echo 'b';
    }

    public function bigTalk(){
        echo 'B';
    }
}
class Talker{
    use A,B {
        A::smalltalk    insteadof B;
        B::bigTalk      insteadof A;
    }
}
$obj = new Talker();
$obj->smallTalk();
$obj->bigTalk();
?>




