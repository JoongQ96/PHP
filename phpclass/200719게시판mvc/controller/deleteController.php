<?php
// view.php 에서 글 삭제 버튼 클릭 후
session_start();
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);



if (isset($_SESSION['id'])) {
    // login 한 경우
    $boardID       = $_GET['board_id'];            // view에서 받아온 게시판 id 값
    $obj           = new board_Query();
    $boardValue    = $obj->selectBoardId($boardID);


} else {
    // login 안 한 경우 세션이 없는 경우
    $goBackPage  = "mainProcess.php";                // 돌아갈 페이지
    message("잘못된 접근입니다.", $goBackPage);
}
echo "boardID : ".$boardID."<br>";



include("../view/delete.php");