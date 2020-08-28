<?php
session_start();
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

$pickTitleNum = $_GET['board_id'];  // list에서 받아온 게시판 글 번호
$_SESSION['board_id'] = $_GET['board_id'];
$obj = new board_Query();
$boardValue = $obj->selectBoardId($pickTitleNum); // 받아온 board_id 값으로 게시글 선택

// ------------>>>>> 수정 필요 <<<<<---------------------------
// ***세션으로 확인하자
//!= ($boardValue->user_name)
if (isset($_SESSION['board_id'])) {
    echo "dd : ".$_SESSION['id']."<br>";
    echo "kk : ".$boardValue->user_name."<br>";
    echo "SESSION['board_id'] : ".$_SESSION['board_id']."<br>";
    echo "ddddddddddddddddddddddddd<br>";
} else {
    $obj->hitUp($pickTitleNum);
}


$searchKeyword = $_GET['keyword'];                // 검색 option 선택 keyword
$searchText    = $_GET['searchText'];             // 검색 내용
$searchBtn     = $_GET['searchBtn'];              // 검색 버튼 누른 것에 대한 값
$nowPage       = $_GET['nowPage'];                // list의 페이징 된 버튼을 클릭한 경우 페이지 번호

include("../view/view.php");





