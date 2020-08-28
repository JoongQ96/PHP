<?php
class ClassA{
    function __construct(){
        print "Class A's constructor is invoked"."<br>";
    }
    function __destruct(){
        print "Class A's destructor is invoked"."<br>";
    }
}
$obj = new ClassA();

echo "Before destroying<br>";
unset($obj);
echo "After destroying<br>";
?>






