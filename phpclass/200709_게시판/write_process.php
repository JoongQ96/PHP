
<?php
date_default_timezone_set('Asia/Seoul'); // db 시간대 한국(서울)으로 설정

//////////////////////////////////// DB 연결 설정 ////////////////////////////////////
require_once("db_conf.php");
$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
//////////////////////////////////// DB 연결 실패 ////////////////////////////////////
if ($db_conn->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
//////////////////////////////////// DB 연결 성공 ////////////////////////////////////
// 유효성 검사
if (isset($_GET['userTitle']) && isset($_GET['userName']) && isset($_GET['userPassword']) && isset($_GET['content'])){
    // 공란 검사
    if (($_GET['userTitle'] == '') || ($_GET['userName'] == '') || ($_GET['userPassword'] == '') || ($_GET['content'] == '')) {
        // 글 제목, 작성자, 비밀번호, 글 내용 작성하지 않았을 경우
        echo "<script> alert('빈칸확인바람'); </script>";
        echo "<script> location.href='list.php'; </script>"; // list.php 로 이동

    } else{
        // 글 제목, 작성자, 비밀번호, 글 내용 모두 작성한 경우

        $userTitle    = htmlspecialchars("{$_GET['userTitle']}", ENT_QUOTES);                                           // 글 제목, html tag 제거
        $userName     = htmlspecialchars("{$_GET['userName']}", ENT_QUOTES);                                            // 작성자, html tag 제거
        $userPassword = password_hash(htmlspecialchars("{$_GET['userPassword']}", ENT_QUOTES), PASSWORD_DEFAULT);  // 비밀번호, html tag 제거, 비밀번호 암호화
        $content      = htmlspecialchars("{$_GET['content']}", ENT_QUOTES);                                             // 글 내용, html tag 제거

        // 사용자로부터 입력 받은 값 DB로 전송
        //                            (글 제목,  글 작성자,   글 비밀번호,   글 내용,  글 작성일)
        $sql = "insert into mybulletin (title, user_name, user_passwd, contents, reg_date)
                 values ('$userTitle', '$userName', '$userPassword', '$content', now())";
        $result = $db_conn->query($sql);

        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        if (!$result){
            echo "DB에 데이터 입력 실패";
            exit(-1);
        }

        // 게시글 등록 완료된 경우
        echo "<script> alert('게시글이 성공적으로 작성되었습니다.')</script>";
        echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
    }
}
?>