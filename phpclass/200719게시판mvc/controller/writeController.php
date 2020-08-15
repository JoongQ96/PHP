<?php
// write 전용 Controller
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (!isset($_SESSION['id'])) {
    // login 안 한 경우 세션이 없는 경우
    $goBackPage  = "mainProcess.php";                // 돌아갈 페이지
    message("잘못된 접근입니다.", $goBackPage);
}

include("../view/write.php");
