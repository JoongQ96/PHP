<?php
class test {
    private   $p_v   = 18;
    protected $pt_v  = 218;
    public     $pb_v = 21818;

    public function test() {
        foreach ($this as $key => $value){
            echo "{$key} => {$value}<br>";
        }
    }
}

$obj = new test();
$obj->test();








