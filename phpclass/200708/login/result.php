
<?php
// 세션 시작
session_start();

// DB 연결 설정
require_once('db_conf.php');
$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db_name);

//////////////////////////////
// DB 연결 실패
if ($db_conn->errno > 0){
    echo "DB 연결 실패";
    exit(-1);
}
$id = $_POST['id'];       // 사용자로부터 입력 받은 ID 값
$pw = $_POST['password']; // 사용자로부터 입력 받은 Password 값

//////////////////////////////
// DB 연결 성공
// login 기능
$userId   = "SELECT * FROM login WHERE id = '{$id}' AND password = '{$pw}'";
$result   = $db_conn->query($userId);
$userInfo = $result->fetch_assoc();
$checkUserCount = $result->num_rows;

// ID, PW 체크
if ($checkUserCount == 1) {
    // 로그인 성공
    // -> ID/PW 입력
    echo "성공적으로 로그인 하였습니다.<br>";
    ?>
    <input type="button" value="회원정보보기" onclick="location.href='main.php' ">
    <?php
    // 세션 변수 선언
    $_SESSION['login'] = 0;
    $_SESSION['name']  = $userInfo['name'];
    $_SESSION['grade'] = $userInfo['grade'];
    $_SESSION['age']   = $userInfo['age'];

} else {
    // 로그인 실패
    // -> ID/PW 입력 x , ID/PW 틀렸을 경우
    echo "로그인에 실패하였습니다.<br>";
    echo "입력하신 ID 또는 Password를 확인해 주세요.<br>";
    ?>
    <input type="button" value="다시 입력하기" onclick="location.href='main.php' ">
    <?php
}
?>

