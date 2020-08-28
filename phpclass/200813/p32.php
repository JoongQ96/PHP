<?php
function test($data){
    echo $data. "<br>";
}
$t      = new TypeHintingTest();
$obj    = new test();
$t->arrayTest(array(1, 2, 3));
$t->InterfaceTest($obj);
$t->callableTest('test',2);

?>