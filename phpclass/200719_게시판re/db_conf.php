<?php
////////////////////////////////
// -->>internal server error 확인용
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// <<--
////////////////////////////////
// vardump() 쓰자..

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 페이지 환경 설정 파일 연결
require_once('board_conf.php');
// DataBase 환경 설정
class db_info {
    const db_url  = "localhost";
    const user_id = "root";
    const passwd  = "autoset";
    const db      = "ycj_test";
}
// DataBase 연결 함수
function dbConnection(){
    // DataBase 연결
    $db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);

    // DataBase 연결 실패 message
    if ($db_conn->errno > 0) {
        echo "DB 연결 실패";
        exit(-1); // 시스템 종료
    }
    // DataBase 연결 성공시 mysqli 객체 반환
    return $db_conn;
}

// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> alert message 출력 함수
function message($getMessage, $goBackPage){
    $printMessage = "<script> alert('$getMessage');";
    echo $printMessage."location.href = '$goBackPage'; </script>";
    exit(-1);
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 유효성 검사용 함수
function contentCheck($getUserInfo, $goBackPage) {
    $array = [];    // 입력 받은 값들을 담을 배열

    // 유효성 검사 & 공란 확인
    foreach ($getUserInfo as $key => $value) {
        if (isset($_GET[$value])){ // 유효성 확인
            if ($_GET[$value] == ''){ // 공란 확인
                // 공란이 있는 경우
                 message("빈칸을 확인해 주세요.", $goBackPage);
            } else{
                // 공란 없이 전부 입력한 경우
                if ($value == "password") {
                    // 입력 값이 password 경우
                    $array[$value] = password_hash(htmlspecialchars($_GET[$value], ENT_QUOTES), PASSWORD_DEFAULT);
                } else {
                    // 그 외의 입력 값의 경우
                    $array[$value] = htmlspecialchars($_GET[$value], ENT_QUOTES);
                }
            }
        }
    }
    return $array;
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> write 쿼리, 글 등록 함수
function write($getUserInfo){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql = "insert into mybulletin (board_pid, user_name, user_passwd, title, contents, reg_date)
            values ('{$getUserInfo['pid']}', '{$getUserInfo['name']}', '{$getUserInfo['password']}', 
                    '{$getUserInfo['title']}', '{$getUserInfo['content']}', now())";
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    if (!$result){
        echo "DB에 데이터 입력 실패";
        exit(-1);
    }
}
// <<--
// -->> modify 쿼리, 글 수정 함수
function modify($getUserInfo, $boardID){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql = "update mybulletin set title = '{$getUserInfo['title']}', user_name = '{$getUserInfo['name']}', contents = '{$getUserInfo['content']}', reg_date = now() where board_id = {$boardID}";
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    if (!$result){
        echo "DB에 데이터 수정 실패";
        exit(-1);
    }
    // 게시글 수정 완료된 경우 message 출력 후 list.php 로 이동
    message("게시글이 성공적으로 수정되었습니다.",BoardInfo::FILENAME_LIST);
}
// <<--
// -->> delete 쿼리, 글 삭제 함수
function delete($boardID){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql ="delete from mybulletin where board_id = {$boardID}"; // 테이블 제거
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    if (!$result){
        echo "DB에 데이터 삭제 실패";
        exit(-1);
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> view 조회수 증가 함수
function hitUp($pickTitleNum){
    $db_conn = dbConnection();
    // 조회수 증가
    $hitUpSql  = "update mybulletin set hits = hits+1 where board_id={$pickTitleNum}";
    $hitResult = $db_conn->query($hitUpSql);
    if ($hitResult->errno > 0) {
        echo "조회수 증가 실패!";
        exit(-1);
    }
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 선택한 게시글 연산 함수
function selectBoardCalculation($boardID){
    $db_conn = dbConnection();
    $titleSql = "select * from mybulletin where board_id='{$boardID}'";
    $selectResult = $db_conn->query($titleSql);
    if ($selectResult->errno > 0) {
        echo "DB 연결 실패";
        exit(-1);
    }
    return $selectResult->fetch_array();
}

// <<--
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 덧글 출력용 함수
function showComment($boardID, $nowPage){
    $db_conn = dbConnection();
    // 덧글 출력 기능
    $commentViewSql = "select * from mybulletin where board_pid = {$boardID}";
    $resultCommentViewSql = $db_conn->query($commentViewSql);

    // 덧글 출력
    while ($commentView = $resultCommentViewSql->fetch_array()){
        echo "<tr>";
        echo "<td>".$commentView['user_name']."</td>";
        echo "<td>".$commentView['contents']."</td>";
        echo "<td>".$commentView['reg_date']."</td>";
        ?>
        <input type="hidden" name="nowPage" value="<?php echo $nowPage; ?>">
        <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
        <input type="hidden" name="commentUserID" value="<?php echo $commentView['board_id']; ?>">
        <input type="hidden" name="commentUserName" value="<?php echo $commentView['user_name']; ?>">
        <input type="hidden" name="commentUserContents" value="<?php echo $commentView['contents']; ?>">
        <input type="hidden" name="commentUserDate" value="<?php echo $commentView['reg_date']; ?>">
        <?
        echo "<td><input type='submit' name='deleteComment' value='삭제'></td>";
        echo "</tr>";
    }
}
// <<--


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 리스트 출력 연산을 위한 함수
// function calculateList($searchOption, $searchText){}
// <<--








?>