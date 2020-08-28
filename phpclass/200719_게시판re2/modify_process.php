<?php require_once('db_conf.php'); echo "modify_process 파일<br>"; ?>
<?php
$db_conn = dbConnection();
$userBoardId = $_GET['CheckBoardID']; // modify애서 받아온 게시판 id 값
///////////////////////////////////////////////////////////////////////
// 선택한 게시글 쿼리 함수
$totalRowNum  = selectBoardCalculation($userBoardId);
$userPasswd   = $totalRowNum['user_passwd'];   // 기존의 비밀번호

///////////////////////////////////////////////////////////////////////
$modifyTitle   = $_GET['title'];          // 변경할 제목
$modifyName    = $_GET['name'];           // 변경할 이름
$modifyContent = $_GET['content'];        // 변경할 내용
$checkPasswd   = $_GET['checkPasswd'];    // 비밀번호 일치 확인용, 입력 받은 값

///////////////////////////////////////////////////////////////////////
$getUserInfo = ['title','name','checkPasswd','content'];            // 사용자에게 입력 받은 값들의 배열
$goBackPage  = BoardInfo::FILENAME_VIEW."?board_id={$userBoardId}"; // 돌아갈 페이지 (modify.php)
$array = [];                                                        // 입력 데이터 처리 후 넣어 줄 배열
$array = contentCheck($getUserInfo, $goBackPage);                   // 유효성 검사, 공란 검사, html tag 제거

// 비밀번호 일치 여부 확인
if (password_verify($checkPasswd, $userPasswd)){
    // 비밀번호 일치, 게시글 수정을 위한 함수 호출
    modify($array, $userBoardId);
    // 게시글 수정 완료된 경우 message 출력 후 list.php 로 이동
    message("게시글이 성공적으로 수정되었습니다.", $goBackPage);
} else {
    // 비밀번호 불일치, list.php 로 이동
    message("비밀번호를 확인해 주세요.", $goBackPage);
}
?>





