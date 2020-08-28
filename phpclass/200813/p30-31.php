<?php
interface testInt {
    public function prtInt();
} 
class test implements testInt {
    public function prtInt(){
        echo "prtInt() in test is invoked<br>";
    }
}

class TypeHintingTest{
    function arrayTest (array $a){
        foreach($array as $key => $value)
            echo "{$key} => {$value}";
    }

    function InterfaceTest (testInt $i){
        $i->prtInt();
    }
    
    function callableTest (callable $c, $data){
        call_user_func($c, $data);
    }    
}

$t = new TypeHintingTest();

$t->arrayTest(1);
$t->InterfaceTest(1818218);
$t->callableTest(1,2);
?>