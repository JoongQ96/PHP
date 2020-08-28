<?php
session_start();
session_destroy(); // $_SESSION 배열 모든 값 삭제

//echo $_SESSION['name']."<br>"; // error undefined index