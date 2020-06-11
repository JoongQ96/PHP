<?php
require_once('db_conf.php');
// DBMS 연결, 연결 성공 시 mysqli 객체 반환, 연결 실패 시 False
$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);

// DBMS 연결 실패 여부 검사
if ($db_conn->connect_error) {
    // "connect_errorno"는 정수 값 가짐. 0는 Error 없음. 그 이외에 값은 Error type 정의
    // Error type은 MySQL 문서 참고
    echo "Failed to connect to the MySQL Server";
    exit(-1);   // 시스템 종료 : PHP 엔진 번역 작업 중지, 프로그램 종료.
                // DBMS 연결 실패 후 아래 코드 실행 의미 없음
} else
    echo "DB connection is successfully established";

// table에 레코드를 삽입 할 SQL문 작성
$sql_stmt = 'insert into customer values(1, "L1234", "12345a", "YCJUNG", "J1", 22)';
// DBMS에 Query 전송
// DML(Data Manipulation Language) [insert, update, delete]의 경우
// Query 성공 시 true, 실패 시 false 반환
if ($result = $db_conn->query($sql_stmt))
    echo "데이터 삽입 성공<br>";
else
    echo "데이터 삽입 실패<br>";


// customer 테이블 내 레코드 검색 SQL문 작성
$sql_stmt = 'select * from customer';

// DBMS에 Query 전송
// non-DML(Data Manipulation Language)[not insert, update, delete]의 경우
// Query 성공 시 mysqli_result 객체 반환, 실패 시 false 반환
if ($result = $db_conn->query($sql_stmt)) {
    // fetch_assoc() : DBMS로 부터 획득한 레코드를 Association array로 반환
    // fetch_assoc()를 호출 할 때마다 획득한 레코드를 Top에서 Bottom 순서로 반환
    // 더 이상 반환 레코드가 없을 시 null 반환
    while($row = $result->fetch_assoc()) {
        echo $row['customerid'].":".$row['id'].":".$row['password'].":".$row['name'].
             ":".$row['level'].":".$row['age']."<br>";
    }
}
else
    echo "데이터 검색 실패<br>";

