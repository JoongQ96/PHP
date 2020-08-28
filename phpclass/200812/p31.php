<?php
trait PropertiesTrait {
    public $same        = true;
    public $different   = false;
    private $test       = 18;
}

class PropertiesExample {
    use PropertiesTrait;
    public $same        = true;
    public $different   = true;
    private $test;
}
?>



