<?php
session_start();

// 현 세션에 저장 된 변수 값 출력
foreach ($_SESSION as $key => $value)
    echo $key." : ".$value."<br>";


// 현 세션에 저장 된 변수 값 출력
// unset($_SESSION['name']);