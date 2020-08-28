<?php
// write Controller
session_start();
require_once ('../model/boardModel.php');
require_once ('library.php');

// login 안 한 경우 세션이 없는 경우, 페이지 이동
commonFunc::sessionCheck("boardController.php");

include("../view/write.php");




