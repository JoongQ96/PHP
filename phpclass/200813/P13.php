<?php
// p13
//class A {
//    public $ma = 10;
//    public $mb = 20;
//
//    function __clone() {    // 매직 함수
//        echo "__clone() is invoked <br>";
//    }
//
//    function setMB($argValue) {
//        $this->mb = $argValue;
//    }
//}
//
//$obj = new A();
//$obj->setMB(18);
//
//$objClone = clone $obj;     // 객체 복제
//
//echo "MB Value of the cloned object : ".$objClone->mb;
//



//class A {
//    public $value = 2;
//
//    public $myList = array(5,4,3); // myList는 배열의 주소 값 저장
//}
//$obj1 = new A();
//
//// 객체 복사를 위한 연산자 or 키워드 제공 : clone
//// 사용법 : clone 복사 대상 객체의 주소
//
//$obj2 = clone $obj1;
//
//$obj1->myList[0] = 10;
//
//echo $obj2->myList[0];

//class B{
//    public $bar = "foo";
//}
//class A {
//    public $value = 2;
//    public $myList = array(5,4,3); // myList는 배열의 주소 값 저장
//    public $myObj;
//
//    function setObj($argObj){
//        $this->myObj = $argObj;
//    }
//    function __clone(){
//        echo "kkk<br>";
//    }
//}
//$obj1 = new A();
//$obj1->setObj(new B());
//
//$obj2 = clone $obj1;
//
//$obj1->myObj->bar = "ycjung";
//echo $obj2->myObj->bar;

//class B{
//    public $bar = "foo";
//}
//class A {
//    public $myObj;
//
//    function setObj($argObj){
//        $this->myObj = $argObj;
//    }
//    function __clone(){
//        $this->myObj = clone $this->myObj;
//    }
//}
//$obj1 = new A();
//$obj1->setObj(new B());
//
//$obj2 = clone $obj1; // 얕은 복사(shallow copy)로 구현이 된다.
//                     // 복사 대상은? 객체의 멤버 변수(property : 속성)
//                     // Scalar (Primitive) 값은 그냥 원 값이 복사 된다.
//                     // Reference 값은 주소 값이 복사 된다.
//




class A {
    static public $cloneObjCount = 0;
    public $value = 2;

    function __clone(){
        self::$cloneObjCount++;
    }
}
$obj1 = new A();
$obj2 = clone $obj1;
$obj3 = clone $obj1;
$obj4 = clone $obj1;

echo A::$cloneObjCount;






