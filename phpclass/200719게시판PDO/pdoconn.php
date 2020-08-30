<?php
include_once 'dbinfo.php';
try{
    // MySQL PDO 객체 생성
    $dbconn = new PDO('mysql:host='.$db['host'].';dbname='.$db['name'].';charset=utf8', $db['user'], $db['pass']);

    // 에러 출력
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
    echo 'Failed to obtain database handle : '.$e->getMessage();
}
?>
