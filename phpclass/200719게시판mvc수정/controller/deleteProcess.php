<?php
// delete.php 에서 글 삭제 버튼 클릭 후
session_start();
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

$boardID       = $_POST['boardID'];
$commentID     = $_POST['commentUserID'];
$obj           = new board_Query();
// 선택한 게시글 쿼리 함수
$totalRowNum   = $obj->selectBoardId($boardID); // 쿼리 연산
$userPasswd    = $totalRowNum->user_passwd;     // 기존의 비밀번호
$boardUserName = $totalRowNum->user_name;       //
$goBackPage    = "boardController.php";            // 돌아갈 페이지 (view.php)
$array = [];                                    // 입력 데이터 처리 후 넣어 줄 배열

if (isset($_POST['delComment'])) {
    $nowPage     = $_POST['nowPage'];
    $obj->delete($commentID);
    // 비밀번호 일치, 덧글 삭제 완료된 경우, view.php 로 이동
    commonFunc::message("덧글이 성공적으로 삭제되었습니다.", $goBackPage);

} else {
    $checkPasswd   = $_POST['checkPasswd'];      // 사용자에게 입력 받은 비밀번호
    $nowUserID     = $_POST['userID'];           // 현재 로그인된 사용자
    $getUserInfo   = $_POST['checkPasswd'];      // 사용자에게 입력 받은 값들의 배열
    $array         = commonFunc::contentCheck($checkPasswd, $goBackPage);   // 유효성 검사, 공란 검사, html tag 제거

    // 비밀번호 일치 여부 확인
    if (password_verify($checkPasswd,$userPasswd)){ // 패스워드 확인
        // 글 작성자 일치 여부 확인
        if ($nowUserID == $boardUserName){
            // 게시글 삭제
            $obj->delete($boardID);
            // 비밀번호 일치, 게시글 삭제 완료된 경우, list.php 로 이동
            commonFunc::message("게시글이 성공적으로 삭제되었습니다.", $goBackPage);
        }
    } else {
        // 비밀번호 불일치, list.php 로 이동
        commonFunc::message("비밀번호를 확인해 주세요.", $goBackPage);
    }
}