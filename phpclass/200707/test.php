<?php
require_once('db_conf.php');
function makeDBConnection() {
    // DBMS 연결, 연결 성공 시 mysqli 객체 반환, 연결 실패 시 False
    $db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db_name);

    // DBMS 연결 실패 여부 검사
    if ($db_conn->connect_errno) {
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. Code num 1";
        exit(-1);   // 시스템 종료 : PHP 엔진 번역 작업 중지, 프로그램 종료.
    }
    return $db_conn;
}

// 방문자 수 1 증가
function updateVisitingCounter() {
    $db_conn = makeDBConnection();

    $sql = "update visitorcount set vc = vc + 1";

    if (!($db_conn->query($sql))) {
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. Code num 2";
        exit(-1);   // 시스템 종료 : PHP 엔진 번역 작업 중지, 프로그램 종료.
    }
}

// 총 방문자 수
function getVisitingCounter() {
    $db_conn = makeDBConnection();

    $sql = "select * from visitorcount";

    if (!($result = $db_conn->query($sql))) {
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. Code num 3";
        exit(-1);   // 시스템 종료 : PHP 엔진 번역 작업 중지, 프로그램 종료.
    }
//    return $result->fetch_array()[0];
    return $result->fetch_array()[0];
}

// 쿠키 값 확인
if(!isset($_COOKIE['visited'])) {
    updateVisitingCounter();    // 쿠키가 없을 경우, 초기 접속, 카운터 증가
    setcookie("visited", true, 0);  // 쿠키 설정
}

echo "총 방문자 수 : ".getVisitingCounter();