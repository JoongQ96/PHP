<?php require_once('db_conf.php'); echo "write_process_comment 파일<br>"; ?>
<?php
// $db_conn = dbConnection();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$viewNowPage      = $_GET['CheckNowPage']; // 게시글의 현재 블록의 페이지 번호
$commentParentNum = $_GET['pid'];          // hidden으로 받아온 게시글 번호
$commentUser      = $_GET['name'];         // 덧글 작성자 이름
$commentContent   = $_GET['content'];      // 덧글 내용
$commentPw        = $_GET['password'];     // 덧글 비밀번호

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$getUserInfo = ['pid','name','password','content'];                                             // 사용자에게 입력 받은 값들의 배열
$goBackPage  = BoardInfo::FILENAME_VIEW."?board_id={$commentParentNum}&nowPage={$viewNowPage}"; // 돌아갈 페이지
$array = [];                                                                                    // 입력 데이터 처리 후 넣어 줄 배열
$array = contentCheck($getUserInfo, $goBackPage);                                               // 유효성 검사, 공란 검사, html tag 제거, 비밀번호 암호화
write($array);                                                                                  // 덧글 등록 쿼리 함수

// 덧글 등록 완료된 경우 message 출력 후 view.php 로 이동
message("덧글이 성공적으로 작성되었습니다.", BoardInfo::FILENAME_VIEW."?board_id={$commentParentNum}&nowPage={$viewNowPage}");
?>
