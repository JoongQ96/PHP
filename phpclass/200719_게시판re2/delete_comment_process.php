<?php require_once('db_conf.php'); echo "delete_comment_process 파일<br>"; ?>
<?php
$db_conn = dbConnection();

$board_id        = $_GET['boardID'];
$nowPage         = $_GET['nowPage'];
$userInputPasswd = $_GET['userInputPasswd'];    // 사용자에게 입력 받은 덧글 비밀번호
$commentBoardID  = $_GET['commentBoardID'];     // hidden으로 받아온 덧글 id 값

$totalRowNum = selectBoardCalculation($commentBoardID);
$userPasswd   = $totalRowNum['user_passwd'];   // 기존의 비밀번호

///////////////////////////////////////////////////////////////////////
$getUserInfo = ['userInputPasswd'];                 // 사용자에게 입력 받은 값들의 배열
$goBackPage  = BoardInfo::FILENAME_VIEW."?board_id={$board_id}&nowPage={$nowPage}";            // 돌아갈 페이지 (view.php)
$array = [];                                        // 입력 데이터 처리 후 넣어 줄 배열
$array = contentCheck($getUserInfo, $goBackPage);   // 유효성 검사, 공란 검사, html tag 제거

// 비밀번호 일치 여부 확인
if (password_verify($userInputPasswd,$userPasswd)){ // 패스워드 확인
    // 게시글 삭제
    delete($commentBoardID);
    // 비밀번호 일치, 덧글 삭제 완료된 경우, view.php 로 이동
    message("덧글이 성공적으로 삭제되었습니다.",$goBackPage);
} else {
    // 비밀번호 불일치, view.php 로 이동
    message("비밀번호를 확인해 주세요.",$goBackPage);
}
