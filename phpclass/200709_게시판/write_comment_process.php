<?php
require_once('write_process.php');
echo "write_comment_process 페이지 입니다.<br>";

$viewNowPage      = $_GET['CheckNowPage'];    // 게시글의 현재 블록의 페이지 번호
$commentParentNum = $_GET['CheckBoardID'];    // hidden으로 받아온 게시글 번호
$commentUser      = $_GET['commentUser'];     // 덧글 작성 유저 이름
$commentContent   = $_GET['commentContent'];  // 덧글 내용
$commentPw        = $_GET['commentPw'];       // 덧글 비밀번호


echo "commentParentNum : ".$commentParentNum."<br>";
echo "commentUser : ".$commentUser."<br>";
echo "commentTitle : ".$commentContent."<br>";
echo "commentPw : ".$commentPw."<br>";

// 유효성 검사
if (isset($commentUser) && isset($commentContent) && isset($commentPw)){
    // 공란 검사
    if (($commentUser == '') || ($commentContent == '') || ($commentPw == '')){
        // 공란o, 작성한 덧글에 유저 이름, 덧글 내용, 덧글 비밀번호를 입력하지 않은 경우
        echo "<script> alert('빈칸확인바람'); </script>";
        echo "<script> location.href='view.php?board_id={$commentParentNum}&nowPage={$viewNowPage}'; </script>"; // view.php 로 이동
    } else {
        // 공란x, 작성한 덧글에 유저 이름, 덧글 내용, 덧글 비밀번호를 모두 입력한 경우
        $cmParentNum = htmlspecialchars("{$_GET['CheckBoardID']}", ENT_QUOTES);                                     // 글 번호, html tag 제거
        $cmUser      = htmlspecialchars("{$_GET['commentUser']}", ENT_QUOTES);                                      // 덧글 작성자, html tag 제거
        $cmPasswd    = password_hash(htmlspecialchars("{$_GET['commentPw']}", ENT_QUOTES), PASSWORD_DEFAULT);  // 덧글 비밀번호, html tag 제거, 비밀번호 암호화
        $cmContent   = htmlspecialchars("{$_GET['commentContent']}", ENT_QUOTES);                                   // 덧글 내용, html tag 제거

        // 쿼리 전송
        $commentSql = "insert into mybulletin (board_pid, user_name, user_passwd, contents, reg_date) 
                          values ('$cmParentNum', '$cmUser','$cmPasswd', '$cmContent', now())";
        $resultCommentSql = $db_conn->query($commentSql);

        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        if (!$resultCommentSql){
            echo "DB에 데이터 입력 실패";
            exit(-1);
        }

        // 덧글 등록 완료된 경우
        // 작성한 덧글의 게시글 view.php 로 이동
        echo "<script> alert('덧글이 성공적으로 작성되었습니다.')</script>";
        echo "<script> location.href='view.php?board_id={$commentParentNum}&nowPage={$viewNowPage}'; </script>"; // view.php 로 이동

    }
}
















