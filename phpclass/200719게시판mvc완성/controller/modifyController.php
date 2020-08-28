<?php
// view.php 에서 글 수정 버튼 클릭 후
session_start();
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

if (isset($_SESSION['id'])) {                     // login 한 경우
    $boardID     = $_POST['boardID'];             // view에서 받아온 게시판 id 값
    $obj         = new board_Query();
    $boardValue  = $obj->selectBoardId($boardID);
    $checkPasswd = "";                            // 수정시 입력용 비밀번호
}
else {                                            // login 안 한 경우 세션이 없는 경우
    $goBackPage  = "boardController.php";             // 돌아갈 페이지
    commonFunc::message("잘못된 접근입니다.", $goBackPage);
}
include("../view/modify.php");





