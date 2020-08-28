<?php
class A {
    protected $name = '정영철';

    public function printName() {
        echo $this->name."<br>";
    }
}

class B extends A {
    protected $age = '38';

    public function printAge() {
        echo $this->age."<br>";
    }

    public function printInfo() {
        echo $this->name."<br>";
        echo $this->age."<br>";
    }
}

$objA = new B();
$objA->printInfo();



