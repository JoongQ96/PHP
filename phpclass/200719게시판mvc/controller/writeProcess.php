<?php
// write 전용 Controller
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

$getUserInfo = ['title','id','password','content'];     // 사용자에게 입력 받은 값들의 배열
$goBackPage  = "../view/main.php";                      // 돌아갈 페이지
$array       = [];                                      // 입력 데이터 처리 후 넣어 줄 배열
$array       = contentCheck($getUserInfo, $goBackPage); // 유효성 검사, 공란 검사, html tag 제거, 비밀번호 암호화

$obj = new board_Query();                               // DB 연결 객체 생성
$obj->write($array);                                    // 게시글 등록 쿼리 함수

// 게시글 등록 완료된 경우 message 출력 후 list.php 로 이동
message("게시글이 성공적으로 작성되었습니다.", $goBackPage);
