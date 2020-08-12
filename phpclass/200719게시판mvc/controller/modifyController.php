<?php
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

$boardId = $_POST['CheckBoardID']; // modify애서 받아온 게시판 id 값

// 선택한 게시글 쿼리 함수
$obj         = new board_Query();                      // db 관련 객체 생성
$totalRowNum = $obj->selectBoardCalculation($boardId);
$userPasswd  = $totalRowNum['user_passwd'];            // 기존의 비밀번호
///////////////////////////////////////////////////////////////////////
$modifyTitle   = $_POST['title'];          // 변경할 제목
//$modifyName    = $_POST['name'];           // 로그인 된 사용자 이름
$modifyContent = $_POST['content'];        // 변경할 내용
$checkPasswd   = $_POST['checkPasswd'];    // 비밀번호 일치 확인용, 입력 받은 값
//$thisUserName  = $_POST['thisUserName'];   // 글 작성자 이름
///////////////////////////////////////////////////////////////////////

$getUserInfo = ['title','name','content'];            // 사용자에게 입력 받은 값들의 배열
$goBackPage  = "viewProcess.php?board_id={$boardId}";        // 돌아갈 페이지
$array = [];                                          // 입력 데이터 처리 후 넣어 줄 배열
$array = contentCheck($getUserInfo, $goBackPage);     // 유효성 검사, 공란 검사, html tag 제거

//if ($modifyName == $thisUserName) {
//    // 글 작성자와 로그인 된 사용자가 일치할 경우 글 수정 실행
//    modify($array, $boardId);
//    // 게시글 수정 완료된 경우 message 출력 후 list.php 로 이동
//    message("게시글이 성공적으로 수정되었습니다.", $goBackPage);
//} else {
//    message("사용자를 다시 확인해 주세요.", $goBackPage);
//}
$obj->modify($array, $boardId);
// 게시글 수정 완료된 경우 message 출력 후 list.php 로 이동
message("게시글이 성공적으로 수정되었습니다.", $goBackPage);