<?php
require_once('db_conf');

function makeDBConnection()
{
    $db_conn = new mysqli(db_info::db_url, db_info:: user_id, db_info:: passwd, db_info::db_name);

    if($db_conn->connect_errno){
        echo "시스템 오류 입니다.";
        exit(-1);
    }
    return $db_conn;
}


?>