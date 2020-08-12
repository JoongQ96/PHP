<?php
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

$pickTitleNum = $_GET['board_id'];                // list에서 받아온 게시판 글 번호
$obj = new board_Query();                         // db 관련 객체 생성
$obj->hitUp($pickTitleNum);                       // 조회수 증가 함수
$boardValue = $obj->selectBoardId($pickTitleNum); // 받아온 board_id 값으로 게시글 선택

$searchKeyword = $_GET['keyword'];                // 검색 option 선택 keyword
$searchText    = $_GET['searchText'];             // 검색 내용
$searchBtn     = $_GET['searchBtn'];              // 검색 버튼 누른 것에 대한 값
$nowPage       = $_GET['nowPage'];                // list의 페이징 된 버튼을 클릭한 경우 페이지 번호

include ('../view/view.php');
?>