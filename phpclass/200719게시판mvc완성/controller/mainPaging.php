<?php
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

// 리스트 출력 연산을 위한 함수
$obj = new board_Query();
$clickPageButton = isset($_GET['nowPage']) ? $_GET['nowPage'] : 1;      // 클릭한 버튼의 입력값 받아옴
$pagingSql       = $obj->querySelect("comment", "0", 0);
$pagingResult    = board_Query::$db_conn->query($pagingSql);

$totalRowNum   = $pagingResult->num_rows;                                // 덧글 제외한 게시글 전체 row 갯수
$showTextNum   = 5;                                                      // 한 페이지 당 출력할 게시글 수
$totalPageNum  = ceil($totalRowNum / $showTextNum);                // 전체 페이지 수
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$showButtonNum = 10;                                                     // 블럭당 출력할 버튼 수
$nowBlockNum   = ceil($clickPageButton / $showButtonNum);          // 현재 블록 number
$startPageNum  = ($nowBlockNum * $showButtonNum) - ($showButtonNum - 1); // 보여줄 블록의 첫번째 버튼
$endPageNum    = $nowBlockNum * $showButtonNum;                          // 보여줄 블록의 마지막 버튼
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$searchKeyword = $_GET['keyword'];     // 검색 시 option 선택 keyword
$searchText    = $_GET['searchText'];  // 검색 내용

// 리스트 출력 함수, $changeSql 반환
$changeSql = $obj->listQuery($clickPageButton, $showTextNum, $searchKeyword, $searchText);











