
<?php
require_once('write_process.php');

$userInputPasswd = $_GET['userInputPasswd'];    // 사용자에게 입력 받은 비밀번호
$boardID         = $_GET['boardID'];            // hidden으로 받아온 게시판 id 값

$titleSql = "select * from mybulletin where board_id={$boardID}";
$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}

$totalRowNum  = $selectResult->fetch_array();
$userPasswd   = $totalRowNum['user_passwd'];   // 기존의 비밀번호

// 유효성 검사
if (isset($userInputPasswd)){
    // 공란 확인
    if ($userInputPasswd == '') {
        // 비밀번호 입력 하지 않은 경우
        echo "<script> alert('빈칸확인바람'); </script>";
        echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
    }else{
        // 비밀 번호 입력한 경우
        if (password_verify($userInputPasswd,$userPasswd)){ // 패스워드 확인
            // 테이블 제거
            $deleteSql ="delete from mybulletin where board_id={$boardID}";
            $deleteSqlResult = $db_conn->query($deleteSql);

            // DB로 쿼리 전송 실패인 경우 프로그램 종료
            if (!$deleteSqlResult){
                echo "DB에 데이터 삭제 실패";
                exit(-1);
            }
            // 게시글 등록 완료된 경우
            echo "<script> alert('게시글이 성공적으로 삭제되었습니다.')</script>";
            echo "<script> location.href='list.php'; </script>"; // list.php 로 이동

        } else {
            echo "<script> alert('비밀번호확인바람'); </script>";
            echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
        }
    }
}










