<?php
// 회원가입 처리 페이지
require_once('db_conf.php');

$getUserInfo = ['id','password','name'];    // 사용자로부터 입력 받은 값들을 배열
$backPage = 'login.php';                    // 돌아갈 페이지
$kokk = [];
$kokk = contentCheck($getUserInfo, $backPage);

newAccount($kokk);

