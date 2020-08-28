<?php
// login 전용 Controller
session_start();
require_once('../model/boardModel.php');
require_once('library.php');

$id = $_POST['id'];       // 사용자로부터 입력 받은 ID 값
$pw = $_POST['password']; // 사용자로부터 입력 받은 Password 값

// DB 연결 설정
$objDB          = new board_Query();
$userCheck      = $objDB->mySelect("accountinfo", $id, $pw);
$userInfo       = $userCheck->fetch_assoc();
$checkUserCount = $userCheck->num_rows; // 정보가 일치하는 유저 정보 1명만 반환
$goBackPage     = "../view/main.php"; // 돌아갈 페이지

// ID, PW 체크
if ($checkUserCount == 1) {
    // 로그인 성공 -> ID/PW 입력 값 일치할 경우
    // 세션들 변수 선언
    $_SESSION['name']     = $userInfo['user_name'];
    $_SESSION['id']       = $userInfo['user_id'];
    $_SESSION['password'] = $userInfo['passwd'];
    $_SESSION['grade']    = $userInfo['grade'];

    // main.php 로 복귀
    message($_SESSION['name']."회원님 환영합니다! ^^...", $goBackPage);

} else {
    // 로그인 실패 -> ID/PW 입력 x , ID/PW 틀렸을 경우, main.php 로 복귀
    message("ID 또는 Password를 확인해 주세요.", $goBackPage);
}