<?php
// 세션 시작 : 세션 기능을 사용 하기전 반드시 선 실행
session_start();

// 현 세션 내 데이터 저장
// 웹 서버 측에 저장
$_SESSION['name'] = "Youngchul Jung";
$_SESSION['age']  = 22;
$_SESSION['age']  = "Yeungjin Univ";