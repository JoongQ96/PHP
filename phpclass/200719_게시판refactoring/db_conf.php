<?php
////////////////////////////////
// -->>internal server error 확인용
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// <<--
////////////////////////////////
// vardump() 쓰자..
?>
<?php
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
    ////////////////////////////////////////////////////////////////////
    echo $printMessage."location.href = '$goBackPage'; </script>";
    exit(-1);
    ///////////////////////////////////////////////////////////
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 유효성 검사용 함수
function contentCheck($getUserInfo, $goBackPage) {
    $array = [];    // 입력 받은 값들을 담을 배열

    // 유효성 검사 & 공란 확인
    foreach ($getUserInfo as $key => $value) {
        if (isset($_POST[$value])){      // 유효성 확인
            if ($_POST[$value] == ''){   // 공란 확인
                // 공란이 있는 경우
                message("빈칸을 확인해 주세요.", $goBackPage);
            } else{
                // 공란 없이 전부 입력한 경우
                if ($value == "password") {
                    // 입력 값이 password 경우
                    $array[$value] = password_hash(htmlspecialchars($_POST[$value], ENT_QUOTES), PASSWORD_DEFAULT);
                } else {
                    // 그 외의 입력 값의 경우
                    $array[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
                }
            }
        }
    }
    return $array;  // 배열 반환
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> DB 쿼리 전송시 error 출력 메세지
function errorMsg($result){
    if (!$result){
        echo "DB 데이터 전송 실패";
        exit(-1);
    }
}
// <<--

// -->> write 쿼리, 글 등록 함수
function write($getUserInfo){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql = "insert into mybulletin (board_pid, user_name, user_passwd, title, contents, reg_date)
            values ('{$getUserInfo['pid']}', '{$getUserInfo['name']}', '{$getUserInfo['password']}', 
                    '{$getUserInfo['title']}', '{$getUserInfo['content']}', now())";
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    errorMsg($result);
}
// <<--
// -->> modify 쿼리, 글 수정 함수
function modify($getUserInfo, $boardID){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql = "update mybulletin set title = '{$getUserInfo['title']}', user_name = '{$getUserInfo['name']}', 
                                  contents = '{$getUserInfo['content']}', reg_date = now() where board_id = {$boardID}";
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    errorMsg($result);
}
// <<--
// -->> delete 쿼리, 글 삭제 함수
function delete($boardID){
    $db_conn = dbConnection();  // DataBase 연결 함수 호출
    $sql ="delete from mybulletin where board_id = {$boardID}"; // 테이블 제거
    $result = $db_conn->query($sql);

    // DB로 쿼리 전송 실패인 경우 프로그램 종료
    errorMsg($result);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> view 조회수 증가 함수
function hitUp($pickTitleNum){
    $db_conn = dbConnection();
    // 조회수 증가
    $hitUpSql  = "update mybulletin set hits = hits+1 where board_id={$pickTitleNum}";
    $hitResult = $db_conn->query($hitUpSql);
    errorMsg($hitResult);
}
// <<--

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> 선택한 게시글 연산 함수
function selectBoardCalculation($boardID){
    $db_conn = dbConnection();
    $titleSql = "select * from mybulletin where board_id='{$boardID}'";
    $selectResult = $db_conn->query($titleSql);
    errorMsg($selectResult);
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
// --> 리스트 출력용 함수
function listQuery($clickPageButton, $showTextNum, $searchKeyword, $searchText){
    $db_conn = dbConnection();
    $nowPage = ($clickPageButton - 1) * $showTextNum; // 버튼을 클릭시 실행, 클릭한 버튼의 숫자를 연산, 출력할 row의 번호

    // 버튼 클릭 했을 경우의 페이지
    if ($searchKeyword == null){    // 검색 안한 경우
        $sql = "select * from mybulletin where board_pid=0 ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
    } else {                        // 검색 한 경우
        switch ($searchKeyword) {   // 검색 시 option 선택 keyword에 맞게 변수 설정
            case $searchKeyword == "제목":
                $pickKeyword = "title";
                break;

            case $searchKeyword == "내용":
                $pickKeyword = "contents";
                break;

            case $searchKeyword == "작성자":
                $pickKeyword = "user_name";
                break;

            default :
                $pickKeyword = null;
        }
        if ($searchKeyword == "제목_내용") {    // 제목 + 내용으로 검색한 경우
            $sql       = "select * from mybulletin where title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 order by board_id desc limit {$nowPage},{$showTextNum}";
            $changeSql = "select * from mybulletin where title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 order by board_id";
        } else {                              // 제목 or 내용 or 작성자로 검색한 경우
            $sql       = "select * from mybulletin where {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id desc limit {$nowPage},{$showTextNum}";
            $changeSql = "select * from mybulletin where {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id";
        }
    }
    $pagingSqlResult = $db_conn->query($sql);    // 선택된 쿼리문 전송

    // table 출력
    while ($showRow = $pagingSqlResult->fetch_array()){
        echo "<tr>";
        echo "<td>".$showRow['board_id']."</td>";
        if ($searchKeyword == null){    // 검색을 안한 경우
            echo "<td><a href='view.php?board_id={$showRow['board_id']}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
        }else{                          // 검색을 한 경우
            echo "<td><a href='view.php?board_id={$showRow['board_id']}&keyword={$searchKeyword}&searchText={$searchText}&searchBtn=검색&thisPage={$clickPageButton}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
        }
        echo "<td>".$showRow['user_name']."</td>";
        echo "<td>".$showRow['hits']."</td>";
        echo "<td>".date_format(date_create($showRow['reg_date']),'Y-m-d')."</td>";
        echo "</tr>";
    }
    return $changeSql; // 검색시 변환할 쿼리 반환
}
// <<--
?>