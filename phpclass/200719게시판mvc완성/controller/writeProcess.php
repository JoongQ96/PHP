<?php
// write Process
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

$goBackPage  = ""; // 페이지 이동 할 문자열
$array       = []; // 입력 데이터 처리 후 넣어 줄 배열
$getUserInfo = []; // 유저로부터 입력받은 값을 넣어줄 배열
$message     = ""; // 메세지 입력 할 문자열

if (isset($_POST['newBoard'])) {                            // 게시글 작성
    $getUserInfo = ['title','id','password','content'];     // 사용자에게 입력 받은 값들의 배열
    $goBackPage  = "boardController.php";                      // 돌아갈 페이지
    $message     = "게시글이 성공적으로 작성되었습니다.";
}
elseif (isset($_POST['newComment'])) {          // 덧글 작성
    $viewNowPage      = $_POST['CheckNowPage']; // 게시글의 현재 블록의 페이지 번호
    $commentParentNum = $_POST['pid'];          // hidden 값 으로 받아온 게시글 번호
    $commentUser      = $_POST['name'];         // 덧글 작성자 이름
    $commentContent   = $_POST['content'];      // 덧글 내용
    $commentPw        = $_POST['password'];     // 덧글 비밀번호

    $getUserInfo = ['pid','id','password','content'];                                        // 사용자에게 입력 받은 값들의 배열
    $goBackPage  = "viewController.php?board_id={$commentParentNum}&nowPage={$viewNowPage}"; // 돌아갈 페이지
    $message     = "덧글이 성공적으로 작성되었습니다.";
}
else {                                 // error
    $goBackPage  = "boardController.php"; // 돌아갈 페이지
    $message = "게시글 작성 실패 !!!";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['newBoard']) || isset($_POST['newComment'])){
    $array = commonFunc::contentCheck($getUserInfo, $goBackPage); // 유효성 검사, 공란 검사, html tag 제거, 비밀번호 암호화
    $obj = new board_Query();                                     // DB 연결 객체 생성
    $obj->write($array);                                          // 게시글 등록 쿼리 함수
}
commonFunc::message($message, $goBackPage);                       // 게시글 등록 완료된 경우 message 출력 후 페이지 이동





