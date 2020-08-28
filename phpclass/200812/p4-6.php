<?php
// p4-6
abstract class AbstractClass {

    // Force Extending class to define this method
    abstract protected function getValue();
    abstract protected function prefixValue($prefix);

    // Common method
    public function printOut(){
        print $this->getValue() . "\n";
    }
}

class ConcreteClass extends AbstractClass {

    protected function getValue(){
        return "ConcreteClass";
    }

    public function prefixValue($prefix){
        return "{$prefix}ConcreteClass";
    }
}

$obj = new ConcreteClass();
echo $obj->printOut()."<br>";
echo $obj->prefixValue("test")."<br>";





