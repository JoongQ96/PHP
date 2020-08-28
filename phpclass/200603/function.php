<?php
//// p.03
//// 함수 선언식(Function declaration)
//function println($msg) {
//    echo $msg."<br>";
//}
//// 함수 표현식(Function expression), 익명 함수(Anonymous function)
//$print = function ($msg) {
//    echo $msg;
//};
//
//println("Youngchul Jung");  // Youngchul Jung
//print("Richard Jung");           // Richard Jung
?>
<?php
// p.08
//class Foo {
//    public $value = 2;
//}
//$myObj1 = new Foo();
//$value1 = 4;
//
//function changeObjValue($argObj, $argValue) {
//    $argObj -> value = $argValue;
//    $argValue++;
//}
//
//// $myObj1 : Call-by-reference
//// $value1 : Call-by-value
//changeObjValue($myObj1, $value1);
//
//echo $myObj1 -> value." : ".$value1."<br>"; // 4 : 4
//?>
<?php
//// p.09
//$myArray = [10, 1, 2, 3];
//
//function changeArrayValue($argArray, $argIndex, $argValue) {
//    // $argArray는 복사된 배열의 값이다.
//    $argArray[$argIndex] = $argValue;
//}
//
//// PHP의 함수 특징 : 배열의 경우 Call-by-Value로 전달된다.
//changeArrayValue($myArray, 0, 0);
//var_dump($myArray);
?>
<?php
// p.10-1
//$value_1 = 1;
//
//function increment($argValue) {
//    $argValue++;
//}
//// $value_1 : Call-by-Value
//increment($value_1);
//echo $value_1."<br>"; // 1
?>
<?php
//// p.10-2
//$value_1 = 1;
//
//// $argValue 변수에 & 연산자 추가
//// $argValue 변수에 인자 값의 메모리 주소값 저장
//function increment(&$argValue) {
//    $argValue++;
//}
//// $value_1 : Call-by-reference
//increment($value_1);
//echo $value_1."<br>"; // 2
?>
<?php
// p.11
//$myArray = [10, 1, 2, 3];
//
//// $argArray : Call-By-Reference
//function changeArrayValue(&$argArray, $argIndex, $argValue){
//    $argArray[$argIndex] = $argValue;
//}
//changeArrayValue($myArray, 0, 0);
//
//var_dump($myArray); // 0, 1, 2, 3
//
?>
<?php
// p.13
//$sum = function ($argA, $argB){
//    echo "$argA + $argB = ".($argA + $argB)."<br>";
//};
//
//// 함수를 매개 변수로 전달
//function foo($argFunc){
//    // sum(2,3) 실행
//    $argFunc(2, 3);
//
//    // 함수를 반환 값으로 사용
//    return $argFunc;
//}
//
//$sum_d = foo($sum);
//
//// sum(2,3) 실행
//$sum_d(5,10);
//?>
<?php
//// p.14
//// 익명함수 선언 후 $println 변수에 저장
//$println = function ($argMsg) { echo $argMsg."<br>"; };
//
//function foo ($argFunc, $argA, $argB) {
//    global $println;
//    $println( $argFunc($argA, $argB) );
//}
//
//foo(
//// 익명함수 선언 후 foo 함수 매개변수로 전달
//    function ($argA, $argB){
//        return $argA + $argB;
//    }
//    , 2, 3); // --> 5
//?>
<?php
//// p.15
//// Function hoisiting 지원
//foo(); // --> hello;
//
//function foo() {
//    echo "hello<br>";
//}
//
//// 주의!! 변수는 Hoisting을 지원하지 않는다
//
//echo $value; // Warning! Undefined variable
//
//$value = 3;
//?>
<?php
//// p.16
//function foo($argA){
//    echo $argA;
//}
//
//// Fatal error: Cannot redeclare foo()
//function foo($argA, $argB){
//    echo $argA.":".$argB;
//}
//
//foo("Youngchul");
//foo("Youngchul","Jung");
//
//?>
<?php
// p.17
//function sum(){
//    $argNum = func_num_args();  // 현 실행 함수의 매개변수 갯수 반환
//    echo "매개변수 갯수 : ".$argNum."<br>";
//
//    $argList = func_get_args(); // 현 실행 함수의 매개변수를 배열로 반환
//    $result = 0;
//    foreach($argList as $value)
//        $result += $value;
//
//    return $result;
//}
//$result_1 = sum(1, 2);      // 매개변수 갯수 : 2
//$result_2 = sum(1, 2, 3);   // 매개변수 갯수 : 3
//$result_3 = sum(1, 2, 3, 4);// 매개변수 갯수 : 4
//
//echo $result_1."<br>"; // 3
//echo $result_2."<br>"; // 6
//echo $result_3."<br>"; // 10
?>
<?php
//// p.18
//bar(); // Error
//
//foo(); // 1
//
//// foo() 함수 실행 시 bar 함수가 정의 되고,
//// 함수는 정의 시 전역 Scope으로 올라가게 된다
//bar(); // 2
//
//function foo(){
//    $foo_value = 1;
//    echo $foo_value;
//
//    function bar(){
//        // 함수 내의 접근 가능한 변수는 함수 내 선언 된 변수만 가능
//        // 고찰 : global, GLOBAL 키워드의 사용 이유를 생각해 볼 것!!
//        // echo $foo_value."<br>"; // Unvisible
//        $bar_value = 2;
//        echo $bar_value;
//    }
//}
?>
<?php
//// p.19
//function foo(){
//    echo "Hello YC Jung. You are doing great job!";
//}
//
//$func_name = "foo";
//
//// 변수에 () 연산자가 붙을 경우, 해당 변수명을 가지는 함수를 실행한다.
//$func_name();
//
//class Bar {
//    function prtSomething() {
//        echo "Hello Richard Jung";
//    }
//}
//
//$obj= new Bar();
//
//// 객체 메서드에도 적용가능
//$method_name = "prtSomething";
//$obj->$method_name();
?>

