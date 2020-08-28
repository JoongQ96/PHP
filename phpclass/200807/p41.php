<?php
class OverloadingTest{
    static function __callstatic($name, $parameters){
        echo $name . "(";
        
        foreach($parameters as $value)
            echo $value . ",";
        
        echo ")<br>";
    }
}
OverloadingTest::test(1, "two", 3.0);
?>



