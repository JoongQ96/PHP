<?php
class Main {
    use TraitTest;

    function test1(){
        echo "[Main class: test()2]<br>";
    }
}
$obj = new Main();
$obj->test1();
$obj->test2();
?>




