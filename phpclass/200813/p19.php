<?php
class test {
    private   $p_v  = 18;
    protected $pt_v = 218;
    public    $pb_v = 21818;

    public function test() {
        echo "test() is invoked<br>";
    }
}

$obj = new test();

foreach ($obj as $key => $value){
    // 객체 내 public 속성 순회 가능
    echo "{$key} => {$value}<br>";
}









