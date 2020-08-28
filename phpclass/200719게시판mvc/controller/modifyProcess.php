<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

if (isset($_SESSION['id'])){                 // session check
    $boardID     = $_POST['boardID'];        // view에서 받아온 게시판 id 값
}else{
    $goBackPage  = "main.php";               // 돌아갈 페이지 (list.php)
    message("잘못된 접근입니다.", $goBackPage); // error message 출력
}

$obj         = new board_Query();             // db 관련 객체 생성
$boardValue  = $obj->selectBoardId($boardID); // 게시판 id 값으로 선택한 게시글 select
$checkPasswd = "";                            // 수정시 입력용 비밀번호

include ('../view/modify.php');