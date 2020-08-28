<?php
session_start();
$userID = $_POST['id'];
echo "ddd".$userID;



//if (!isset($userID)) {
//    echo "에러";
//} else {
//}

include_once "view/main.php";


