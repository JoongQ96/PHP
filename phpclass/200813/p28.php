<?php
class TypeHintingTest{
    function testClass (test $c){
        $c->prt();
    }
}

class test{
    function prt(){
        echo "prt() in test is invoked <br>";
    }
}

$c = new test();
$t = new TypeHintingTest();

$t->testClass($c);
$t->testClass(1818218)
?>