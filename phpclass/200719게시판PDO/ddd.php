<?php
$dbHost = "localhost";      // 호스트 주소 (localhost, 120.0.0.1)
$dbName = "myboard";        // DataBase 이름
$dbUser = "root";           // DB 아이디
$dbPass = "autoset";        // DB 패스워드

// PDO + MariaDB 연결하기
$pdo = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
$statement = $pdo -> query("SELECT CURDATE() AS date FROM DUAL");
$row = $statement -> fetch(PDO::FETCH_ASSOC);
echo htmlentities($row['date']);


?>