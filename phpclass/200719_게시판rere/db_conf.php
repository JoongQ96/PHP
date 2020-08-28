<?php
// DataBase 관련
class db_info {
    const db_url  = "localhost";
    const user_id = "root";
    const passwd  = "autoset";
    const db      = "ycj_test";
}


// 메세지 alert 출력
function message($getMessage, $getBackPage){
    $printMessage = "<script> alert('$getMessage');";
    echo $printMessage."location.href = '$getBackPage'; </script>";
    exit(-1);
}

// 유효성 검사
function contentCheck($getUserInfo, $getBackPage) {
    $array = [];

    foreach ($getUserInfo as $key => $value) {
        echo $_GET[$value];
        if ($value == "password") {
            $array[$value] = password_hash($_GET[$value], PASSWORD_DEFAULT);
        } else {
            $array[$value] = htmlspecialchars($_GET[$value]
                , ENT_QUOTES);
        }
    }
    return $array;


}
// 회원가입 쿼리
function newAccount($getUserInfo){
    $sql = "insert into mybulletinuserinfo(accountId, accountPasswd, user_name, accountDate)
                                 values ('{$getUserInfo['id']}', '{$getUserInfo['password']}', '{$getUserInfo['name']}', now())";
    $db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
    $db_conn->query($sql);
}


?>