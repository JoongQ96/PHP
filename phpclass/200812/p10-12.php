<?php
// p10-12
interface engine {
    const cylinder_num = 4;

    public function go();
    public function stop();
}

class BenzEngine implements engine {
    public function go(){
        echo "BenzEngine start<br>";
    }
    public function stop(){
        echo "BenzEngine stop<br>";
    }
}

class NissanQ50 {
    private $engine;

    function __construct($argEngine) {
        $this->engine = $argEngine;
    }

    function go() { $this->engine->go(); }
    function stop() { $this->engine->stop(); }
}

$engine = new BenzEngine();
$q50 = new NissanQ50($engine);
$q50->go();
$q50->stop();




