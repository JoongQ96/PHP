<?php
class OverloadingTest{
    function __call($name, $parameters){
        echo $name . "(";
        
        foreach($parameters as $value)
            echo $value . ",";
        
        echo ")<br>";
    }
}
$obj = new OverloadingTest();
$obj->test(1, "two", 3.0);
?>



