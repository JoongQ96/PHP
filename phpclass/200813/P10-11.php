<?php
// p10-11
class Test {
    private $i_v_1 = "variable 1";
    private $i_v_2 = "";

    function printAllVariable() {
        echo $this->i_v_1.":".$this->i_v_2."<br>";
    }

    function setVariable2($argValue) {
        echo $this->i_v_2 = $argValue;
    }
}

$obj = new Test();
$obj->setVariable2("OpaOpa~~~");

echo serialize($obj);

$byteStream = serialize($obj);
$unserializedObj = unserialize($byteStream);

echo "<br><br>----After unserializing----<br><br>";
$unserializedObj->printAllVariable();