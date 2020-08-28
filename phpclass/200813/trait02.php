<?php


trait A {
    public function smallTalk() {
        echo 'a';
    }
    public function bigTalk() {
        echo 'A';
    }
}
trait B {
    public function smallTalk() {
        echo 'b';
    }
    public function bigTalk() {
        echo 'B';
    }
}
trait C {
    public function smallTalk() {
        echo 'c';
    }
    public function bigTalk() {
        echo 'C';
    }
}

class Talker{
    A::small
}