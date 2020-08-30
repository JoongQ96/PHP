<?php
// DataBase 관련

// --> DB 정보 클래스
class db_info {
    const db_url  = "localhost";
    const user_id = "root";
    const passwd  = "autoset";
    const db      = "myboard";
}
// DB 정보 클래스 <<--

// -->> php DataBase Query 관련 클래스
class board_Query{

    public static $db_conn;

    // -->> DataBase 연결 함수
    public function __construct(){
        // DataBase 연결
        board_Query::$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);

        // DataBase 연결 실패 message
        if (board_Query::$db_conn->errno > 0) {
            echo "DB 연결 실패";
            exit(-1); // 시스템 종료
        }
        return board_Query::$db_conn;
    }
    // DataBase 연결 함수 <<--

    // -->> 로그인 전용 함수
    public function mySelect($user_id, $passwd){
        // select 위한 함수
        $query = $this->querySelect("login", $user_id, $passwd);

        return $result = board_Query::$db_conn->query($query);
    }
    // 로그인 전용 함수 <<--

    // -->> select 쿼리 함수
    public function querySelect($mode, $columnValue01, $columnValue02){
        $query     = "select * from ";
        $plusQuery = "";

        if     ($mode == "login")    { $plusQuery = "accountinfo where user_id = '{$columnValue01}' AND passwd = '{$columnValue02}'"; }
        elseif ($mode == "searching"){ $plusQuery = "board where board_id = '{$columnValue01}' "; }
        elseif ($mode == "paging")   { $plusQuery = "board where board_pid = '{$columnValue01}' "; }
        elseif ($mode == "comment")  { $plusQuery = "board where board_pid = '{$columnValue01}' "; }
        elseif ($mode == "default")  { $plusQuery = "board where "; }

        return $result = $query.$plusQuery;
    }
    // select 쿼리 함수 <<--

    // -->> 선택된 게시글 객체로 반환
    public function selectBoardId($boardID){
        $sql    = $this->querySelect("searching", $boardID, 0);
        $result = board_Query::$db_conn->query($sql);

        return $result->fetch_object();
    }
    // 선택된 게시글 객체로 반환 <<--

    // -->> view 조회수 증가 함수
    public function hitUp($pickTitleNum){
        $hitUpSql  = "update board set hits = hits+1 where board_id={$pickTitleNum}";
        $hitResult = board_Query::$db_conn->query($hitUpSql);
        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        $this->errorMsg($hitResult);
    }
    // view 조회수 증가 함수 <<--


    // -->> write 쿼리, 글 등록 함수
    public function write($getUserInfo){
        $query = "insert into board (board_pid, user_name, user_passwd, title, contents, reg_date)
                  values ('{$getUserInfo['pid']}','{$getUserInfo['id']}','{$getUserInfo['password']}', 
                          '{$getUserInfo['title']}', '{$getUserInfo['content']}', now())";
        $result = board_Query::$db_conn->query($query);
        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        $this->errorMsg($result);
    }
    // write 쿼리, 글 등록 함수 <<--

    // -->> modify 쿼리, 글 수정 함수
    public function modify($getUserInfo, $boardID){
        $sql    = "update board set title = '{$getUserInfo['title']}', user_name = '{$getUserInfo['name']}', 
                                 contents = '{$getUserInfo['content']}', reg_date = now() where board_id = {$boardID}";
        $result = board_Query::$db_conn->query($sql);
        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        $this->errorMsg($result);
    }
    // modify 쿼리, 글 수정 함수 <<--

    // -->> delete 쿼리, 글 삭제 함수
    public function delete($boardID){
        $sql    ="delete from board where board_id = {$boardID}"; // 테이블 제거
        $result = board_Query::$db_conn->query($sql);

        // DB로 쿼리 전송 실패인 경우 프로그램 종료
        $this->errorMsg($result);
    }
    // delete 쿼리, 글 삭제 함수 <<--

    // -->> DB 쿼리 전송시 error 출력 메세지
    public function errorMsg($result){
        if (!$result){
            echo "DB 데이터 전송 실패";
            exit(-1);
        }
    }
    // DB 쿼리 전송시 error 출력 메세지 <<--

    // --> 리스트 출력용 함수
    public function listQuery($clickPageButton, $showTextNum, $searchKeyword, $searchText){

        $nowPage = ($clickPageButton - 1) * $showTextNum; // 버튼을 클릭시 실행, 클릭한 버튼의 숫자를 연산, 출력할 row의 번호

        // 버튼 클릭 했을 경우의 페이지
        if ($searchKeyword == null){    // 검색 안한 경우
            $sql =  $this->querySelect("paging", 0, 0)." ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
        }
        else {                        // 검색 한 경우
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
                $sql       = $this->querySelect("default", 0, 0)
                    ." title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 order by board_id desc limit {$nowPage},{$showTextNum}";
                $changeSql = $this->querySelect("default", 0, 0)
                    ." title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 order by board_id";
            } else {                              // 제목 or 내용 or 작성자로 검색한 경우
                $sql       = $this->querySelect("default", 0, 0)
                    ." {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id desc limit {$nowPage},{$showTextNum}";
                $changeSql = $this->querySelect("default", 0, 0)
                    ." where {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id";
            }
        }
        $pagingSqlResult = board_Query::$db_conn->query($sql); // 선택된 쿼리문 전송

        // table 출력
        while ($showRow = $pagingSqlResult->fetch_array()){
            echo "<tr>";
            echo "<td>".$showRow['board_id']."</td>";
            if ($searchKeyword == null){    // 검색을 안한 경우
                ?>
                <td><a href="<?php echo BoardInfo::FILENAME_VIEW; ?>?board_id=<?php echo $showRow['board_id']; ?>&nowPage=<?php echo $clickPageButton; ?>"><?php echo $showRow['title']; ?></a></td>
                <?php
                //echo "<td><a href='view?board_id={$showRow['board_id']}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
            }else{                          // 검색을 한 경우
                echo "<td><a href='view?board_id={$showRow['board_id']}&keyword={$searchKeyword}&searchText={$searchText}&searchBtn=검색&thisPage={$clickPageButton}
                                    &nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
            }
            echo "<td>".$showRow['user_name']."</td>";
            echo "<td>".$showRow['hits']."</td>";
            echo "<td>".date_format(date_create($showRow['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
        return $changeSql; // 검색시 변환할 쿼리 반환
    }
    // 리스트 출력용 함수 <<--

    // -->> 덧글 출력용 함수
    public function showComment($boardID){

        $commentViewSql       = $this->querySelect("comment", $boardID, 0); // select 쿼리
        $resultCommentViewSql = board_Query::$db_conn->query($commentViewSql);

        // 덧글 출력
        while ($commentView = $resultCommentViewSql->fetch_array()){
            echo "<tr>";
            echo "<td>".$commentView['user_name']."</td>";
            echo "<td>".$commentView['contents']."</td>";
            echo "<td>".$commentView['reg_date']."</td>";
            ?> <input type="hidden" name="commentUserID" value="<?php echo $commentView['board_id']; ?>"> <?php
            if ($_SESSION['id'] == $commentView['user_name']) { echo "<td><input type='submit' name='deleteComment' value='삭제'></td>"; }
            echo "</tr>";
        }
    }
    // 덧글 출력용 함수 <<--
}
// php DataBase Query 관련 클래스 <<-





