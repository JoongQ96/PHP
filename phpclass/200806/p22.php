<?php
class MyClass
{
    const CONSTANT = 'constant value';

    function showConstant() {
        echo self::CONSTANT."<br>";
    }
}

echo MyClass::CONSTANT."<br>";

$classname = "MyClass";
echo $classname::CONSTANT."<br>"; // AS of PHP 5.3.0

$class = new MyClass();
$class->showConstant();

echo $class::CONSTANT."<br>";     // As of PHP 5.3.0
?>



