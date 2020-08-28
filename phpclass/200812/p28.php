<?php
class Talker{
    use A, B {
        A::smalltalk    insteadof B;
        A::bigTalk      insteadof A;
    }
}
$obj = new Talker();
$obj->smallalk();
$obj->bigTalk();
?>







