<?php
// 세션 시작
session_start();
$id = $_POST['id'];       // 사용자로부터 입력 받은 ID 값
$pw = $_POST['password']; // 사용자로부터 입력 받은 Password 값

// DB 연결 설정
require_once('db_conf.php');
$db_conn    = dbConnection();
$goBackPage = BoardInfo::FILENAME_LIST; // 돌아갈 페이지 (list.php)

// login 기능
$userId   = "SELECT * FROM user_info WHERE userid = '{$id}' AND password = '{$pw}'";
$result   = $db_conn->query($userId);
$userInfo = $result->fetch_assoc();
$checkUserCount = $result->num_rows; // 정보가 일치하는 유저 정보 1명만 반환

// ID, PW 체크
if ($checkUserCount == 1) {
    // 로그인 성공 -> ID/PW 입력 값 일치할 경우
    // 세션들 변수 선언
    $_SESSION['id']       = $userInfo['userid'];
    $_SESSION['password'] = $userInfo['password'];
    $_SESSION['name']     = $userInfo['name'];
    $_SESSION['grade']    = $userInfo['level'];
    $_SESSION['age']      = $userInfo['age'];
    // list.php 로 복귀
    message($_SESSION['name']."회원님 환영합니다! ^^...", $goBackPage);
} else {
    // 로그인 실패 -> ID/PW 입력 x , ID/PW 틀렸을 경우, list.php 로 복귀
    message("ID 또는 Password를 확인해 주세요.", $goBackPage);
}
?>

