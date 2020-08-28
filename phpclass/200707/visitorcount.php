
<?php
require_once('db_conf.php');

const isDebuggingMode = true;       // 디버깅을 위한 변수

// DB 연결 설정
$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db_name);

////////////////////////////////////////////////////////

if ($db_conn->errno > 0){   // DB 연결 실패
    echo "연결 실패";
    exit(-1);
}

////////////////////////////////////////////////////////

// DB 연결 성공

// 현 카운터 확인
$sqlSelect = "select * from visitorcount";

$result = $db_conn->query($sqlSelect);

if (!($result)) {
    echo "방문자 값 획득 실패";
}
$count = $result->fetch_assoc();

/////////////////////////////////////////////////////////

// 쿠키 확인
if (!isset($_COOKIE['visit'])){                     // 방문한 적 없는 경우만
    // 카운터 업데이트
    $sqlUpdate = "update visitorcount set vc=vc+1"; // 카운트 증가

    if (!$db_conn->query($sqlUpdate)) {
        echo "DB 데이터 업데이트 실패";
        exit(-1);
    }

    setcookie("visit", 0);                          // 쿠키 변수, 값 설정
}

echo "방문자 수 : ".$count['vc']." 명 입니다.";

// 디버깅
//if (isDebuggingMode) {
//    echo "디버깅<br>";
//    echo $sqlUpdate."<br>";
//}
?>

