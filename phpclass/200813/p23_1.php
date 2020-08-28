<?php

class MyIterator implements Iterator {
    public $value = array(5,4,3);

    public function current(){
        return current($this->value);
    }
    public function key(){
        return key($this->value);
    }
    public function next(){
        next($this->value);
    }
    public function rewind(){
        reset($this->value);
    }
    public function valid(){
        $key = key($this->value);
        return ($key !== false && $key !== null);
    }
}
//
//$obj = new A ;
//foreach ($obj as $key => $value){
//    echo $key.":".$value."<br>";
//}

//class A {
//    public $value = array("a"=>5, "b"=>4, 3);
//
//    function getGenerator(){
//        foreach ($this->value as $key => $value)
//            yield $key => $value;
//    }
//}

// Iterator 만드는 방법? -> 이미 저으이 되어 있다.. 어디에? -> 객체 내
// 근데.. 나만의 Iterator 규칙을 만들고 싶어요.
// 예) 학생 객체내에 성적과 관련된 멤버 변수만 순화하고 싶다.
class Student implements Iterator {
    public $name;
    public $id;
    public $grades; // 성적은 배열 값으로 저장된다.

    function __construct($argName, $argId, $argGrades){
        $this->name  = $argName;
        $this->id    = $argId;
        $this->grades = $argGrades;
    }
    public function valid()
    {
        $key = key($this->grades);

        return ($key !== null && $key !== false);
    }
    public function rewind()
    {
        reset($this->grades);
    }
    public function next()
    {
        next($this->grades);
    }
    public function key()
    {
        return key($this->grades);
    }
    public function current()
    {
        return current($this->grades);
    }
}
//$obj = new Student("ycjung",1234,array("korean"=>100,"math"=>90,"english"=>80));
//// PHP에서 객체 Iteration 경우 아래 규칙 따름
//// Iteration 대상은 인스턴스 멤버 변수 + public 만 가능
//foreach ($obj as $key => $value){
//    echo $key." : ".$value."<br>";
//}


//class B implements IteratorAggregate {
//    public $myList = array(10,9,8);
//    public function getIterator()
//    {
//        return new MyIterator($this->myList);
//    }
//}
//$obj1 = new B;
//
//foreach ($obj1 as $key => $value){
//    echo $key." : ".$value."<br>";
//}

class K {
    public $value = array("a"=>5, "b"=>4, 3);
    function getGenerator(){
        foreach ($this->value as $key=>$value){
            yield $value;
        }
    }
}
$obj = new K();
foreach ($obj->getGenerator() as $key => $value){
    echo $key." : ".$value."<br>";
}









