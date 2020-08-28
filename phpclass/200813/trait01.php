<?php



trait A1 {
    function prt(){
        echo "this is A1";
    }
}

trait A2 {
    function prt(){
        echo "this is A2";
    }
}

class TT{
    function prt(){
        echo "this is TT";
    }
}
class BB extends TT {
    use A1;
}

$obj = new BB();
$obj->prt();








