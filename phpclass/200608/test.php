<?php
class db_info {
    const db_url = "localhost";
    const user_id = "root";
    const passwd = "autoset";
    const db = "ycj_test";
}
$conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);

if ($conn->connect_error) {
    echo "Failed to connect to MySQL: ".$conn->connect_error;
} else
    echo "작동되었습니다.";

$res = $conn->query("select * from customer");
$row = $res->fetch_assoc();
echo $row['id'];