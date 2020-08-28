<?php
//if (isset($_POST['user_name']) && isset($_POST['user_age'])) {
//    if ($_POST['user_name'] == null && $_POST['user_age'] == null) {
//        echo "입력은 하고 넘겨주시지요";
//    } else {
//        echo "{$_POST['user_name']}님 환영합니다.<br>";
//        echo "저도 {$_POST['user_age']}살 입니다.";
//    }
//} else {
//    echo "잘못된 접근";
//}
if (!empty($_POST['user_name']) && !empty($_POST['user_age'])) {
//        if ($_POST['user_name'] == null && $_POST['user_age'] == null) {
//            echo "입력은 하고 넘겨주시지요";
//        } else {
    echo "{$_POST['user_name']}님 환영합니다.<br>";
    echo "저도 {$_POST['user_age']}살 입니다.";
//        }
} else {
    echo "잘못된 접근";
}