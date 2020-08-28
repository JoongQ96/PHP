<?php
if (isset($_GET['user_name']) && isset($_GET['user_age'])) {
    if ($_GET['user_name'] == null && $_GET['user_age'] == null) {
        echo "입력은 하고 넘겨주시지요";
    } else {
        echo "{$_GET['user_name']}님 환영합니다.<br>";
        echo "저도 {$_GET['user_age']}살 입니다.";
    }
} else {
    echo "잘못된 접근";
}