<?php require_once('db_conf.php'); echo "delete_process 파일<br>"; ?>
<?php
$db_conn = dbConnection();
// 선택한 게시글 쿼리 함수
$boardID     = $_GET['boardID'];                 // delete에서 받아온 게시판 id 값
$totalRowNum = selectBoardCalculation($boardID);  // 쿼리 연산
$userPasswd  = $totalRowNum['user_passwd'];       // 기존의 비밀번호
$checkPasswd = $_GET['checkPasswd'];              // 사용자에게 입력 받은 비밀번호

///////////////////////////////////////////////////////////////////////
$getUserInfo = ['checkPasswd'];                     // 사용자에게 입력 받은 값들의 배열
$goBackPage  = BoardInfo::FILENAME_VIEW;            // 돌아갈 페이지 (view.php)
$array = [];                                        // 입력 데이터 처리 후 넣어 줄 배열
$array = contentCheck($getUserInfo, $goBackPage);   // 유효성 검사, 공란 검사, html tag 제거

// 비밀번호 일치 여부 확인
if (password_verify($checkPasswd,$userPasswd)){ // 패스워드 확인
    // 게시글 삭제
    delete($boardID);
    // 비밀번호 일치, 게시글 삭제 완료된 경우, list.php 로 이동
    message("게시글이 성공적으로 삭제되었습니다.",BoardInfo::FILENAME_LIST);
} else {
    // 비밀번호 불일치, list.php 로 이동
    message("비밀번호를 확인해 주세요.",BoardInfo::FILENAME_LIST);
}