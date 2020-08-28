<?php require_once('db_conf.php'); echo "list 파일"; ?>
<head>
    <style>
        .table {
            border-collapse: collapse;
            border-top: 3px solid #168;
        }
        .table th {
            color: #168;
            background: #f0f6f9;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
    </style>
</head>
<body>
<form action="<?php echo BoardInfo::FILENAME_VIEW; ?>" method="get">
    <table class="table">
        <tr><th colspan="5">YC JUNG 게시판</th></tr>
        <tr style="border: #2b303b">
            <td>번호</td>
            <td>제목</td>
            <td>작성자</td>
            <td>조회수</td>
            <td>날짜</td>
        </tr>
        <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
        $clickPageButton   = isset($_GET['nowPage'])? $_GET['nowPage']: 1;      // 클릭한 버튼으로 입력값 받아옴
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $pagingSql     = "select * from mybulletin where board_pid = 0";
        $db_conn       = dbConnection();
        $pagingResult  = $db_conn->query($pagingSql);
        $totalRowNum   = $pagingResult->num_rows;                                // 덧글 제외한 게시글 전체 row 갯수
        $showTextNum   = 5;                                                      // 한 페이지 당 출력할 게시글 수
        $totalPageNum  = ceil($totalRowNum/$showTextNum);                   // 전체 페이지 수
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $showButtonNum = 10;                                                     // 블럭당 출력할 버튼 수
        $nowBlockNum   = ceil($clickPageButton/$showButtonNum);             // 현재 블록 number
        $startPageNum  = ($nowBlockNum * $showButtonNum) - ($showButtonNum - 1); // 보여줄 블록의 첫번째 버튼
        $endPageNum    = $nowBlockNum * $showButtonNum;                          // 보여줄 블록의 마지막 버튼
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $searchKeyword = $_GET['keyword'];     // 검색 시 option 선택 keyword
        $searchText    = $_GET['searchText'];  // 검색 내용

        if (BoardInfo::DEBUGGING_MODE){
            echo "<br>This is Debugging Mode<br>";
            echo "&nbsp&nbsp - totalRowNum 덧글 제외한 게시글 전체 row 갯수 : ".$totalRowNum."<br>";
            echo "&nbsp&nbsp - totalPageNum 전체 페이지 수 : ".$totalPageNum."<br>";
            echo "&nbsp&nbsp - nowBlockNum 현재 블록 number : ".$nowBlockNum."<br>";
            echo "&nbsp&nbsp - startPageNum 보여줄 블록의 첫번째 버튼 : ".$startPageNum."<br>";
            echo "&nbsp&nbsp - endPageNum 보여줄 블록의 마지막 버튼 : ".$endPageNum."<br>";
            echo "&nbsp&nbsp - searchKeyword 검색 시 option 선택 keyword : ".$searchKeyword."<br>";
            echo "&nbsp&nbsp - searchText 검색 내용 : ".$searchText."<br>";
            echo "<br>";
        }



        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($_GET['nowPage']) ) {                         // default 이외의 페이지
            // 버튼을 클릭 했을 때 실행됨
            $nowPage = ($clickPageButton - 1) * $showTextNum;   // 클릭한 버튼의 숫자를 연산, 출력할 row의 번호
            // 버튼 클릭 했을 경우의 페이지

            //////////////////////////////////////////////////////////////////////////////////////////////////
            if ($searchKeyword == null){    // 검색 안한 경우
                $sql = "select * from mybulletin where board_pid=0 ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
            } else {                         // 검색 한 경우
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
                    echo "<td><a href='view.php?board_id={$showRow['board_id']}&keyword={$searchKeyword}&searchText={$searchText}
                                   &searchBtn=검색&thisPage={$clickPageButton}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
                }
                echo "<td>".$showRow['user_name']."</td>";
                echo "<td>".$showRow['hits']."</td>";
                echo "<td>".date_format(date_create($showRow['reg_date']),'Y-m-d')."</td>";
                echo "</tr>";
            }
        }
        else {
            // default 페이지

            if ($searchKeyword == null){    // 검색 안한 경우
                $sql = "select * from mybulletin where board_pid=0 ORDER BY board_id desc limit 0,5";
            } else {

                switch ($searchKeyword) {
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
                    $sql       = "select * from mybulletin where title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 
                              order by board_id desc limit 0,5";
                    $changeSql = "select * from mybulletin where title like '%{$searchText}%' or contents like '%{$searchText}%' and board_pid=0 order by board_id";
                } else {                              // 제목 or 내용 or 작성자로 검색한 경우
                    $sql       = "select * from mybulletin where {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id desc limit 0,5";
                    $changeSql = "select * from mybulletin where {$pickKeyword} like '%{$searchText}%' and board_pid=0 order by board_id";
                }
            }
            $result = $db_conn->query($sql);    // 선택된 쿼리문 전송

            // table 출력
            while ($showRow = $result->fetch_array()){
                echo "<tr>";
                echo "<td>".$showRow['board_id']."</td>";
                if ($searchKeyword == null){    // 검색을 안한 경우
                    echo "<td><a href='view.php?board_id={$showRow['board_id']}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
                }else{                          // 검색을 한 경우
                    echo "<td><a href='view.php?board_id={$showRow['board_id']}&keyword={$searchKeyword}&searchText={$searchText}
                                   &searchBtn=검색&thisPage={$clickPageButton}&nowPage={$clickPageButton}'>".$showRow['title']."</a></td>";
                }
                echo "<td>".$showRow['user_name']."</td>";
                echo "<td>".$showRow['hits']."</td>";
                echo "<td>".date_format(date_create($showRow['reg_date']),'Y-m-d')."</td>";
                echo "</tr>";
            }
        }
        ?>
        <input type="hidden" name="thisPage" value="<?php echo $clickPageButton; ?>">
    </table>
</form>
<?
// 검색후 페이징 기능, 버튼의 숫자 조절
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($searchKeyword != null){        // 검색을 한 경우
    $pagingSql = $changeSql;

    $pagingResult      = $db_conn->query($pagingSql);
    $totalRowNum       = $pagingResult->num_rows;                           // 전체 row 갯수
    $showTextNum       = 5;                                                 // 한 페이지 당 출력할 게시글 수
    $totalPageNum      = ceil($totalRowNum/$showTextNum);              // 전체 페이지 수
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $showButtonNum = 10;                                                    // 블럭당 출력할 버튼 수
    $nowBlockNum   = ceil($clickPageButton/$showButtonNum);            // 현재 블록 number

    $startPageNum = ($nowBlockNum * $showButtonNum) - ($showButtonNum - 1); // 보여줄 블록의 첫번째 버튼
    $endPageNum   = $nowBlockNum * $showButtonNum;                          // 보여줄 블록의 마지막 버튼
}

// 보여줄 블록의 첫번째 버튼 번호가 1보다 작거나 같은 경우 1로 설정
if ($startPageNum <= 1){
    $startPageNum = 1;
}
// 보여줄 블록의 마지막 버튼 번호가 마지막 버튼 번호와 크거나 같은 경우 마지막 페이지로 설정
if ($totalPageNum <= $endPageNum) {
    $endPageNum = $totalPageNum;
}
?>
<div>
    <?php
    // button 기능
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($searchKeyword == null) {       // 검색을 안한 경우
        // << 기능
        if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, << 클릭 불가
            echo "<span><<</span>";
        } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, << 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $clickPageButton-1; ?>"><<</a>
            <?php
        }
        // 버튼 출력
        for ($num = ($startPageNum); $num <= $endPageNum; $num++){
            if ($num == $clickPageButton){      // 출력된 블록 안의 클릭된 숫자의 경우, 클릭 불가
                ?>
                <span  style="color: red"><?php echo $num; ?></span>
                <?php
            } else{                             // 출력된 블록 안의 클릭되지 않은 숫자의 경우, 클릭 가능
                ?>
                <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $num; ?>"><?php echo $num; ?></a>
                <?php
            }
        }
        // >> 기능
        if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, >> 클릭 불가
            echo "<span>>></span>";
        } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, >> 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $clickPageButton+1;?>">>></a>
            <?php
        }

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    else {                              // 검색을 한 경우
        // << 기능
        if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, << 클릭 불가
            echo "<span><<</span>";
        } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, << 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword;?>&searchText=<?php echo $searchText; ?>
                     &searchBtn=검색&nowPage=<?php echo $clickPageButton-1; ?>"><<</a>
            <?php
        }
        // 버튼 출력
        for ($num = ($startPageNum); $num <= $endPageNum; $num++){
            if ($num == $clickPageButton){      // 출력된 블록 안의 클릭된 숫자의 경우, 클릭 불가
                ?>
                <span  style="color: red"><?php echo $num; ?></span>
                <?php
            } else{                             // 출력된 블록 안의 클릭되지 않은 숫자의 경우, 클릭 가능
                ?>
                <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword;?>&searchText=<?php echo $searchText; ?>
                         &searchBtn=검색&nowPage=<?php echo $num; ?>"><?php echo $num; ?></a>
                <?php
            }
        }
        // >> 기능
        if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, >> 클릭 불가
            echo "<span>>></span>";
        } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, >> 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword;?>&searchText=<?php echo $searchText; ?>
                     &searchBtn=검색&nowPage=<?php echo $clickPageButton+1;?>">>></a>
            <?php
        }
    }
    ?>
</div>
<br>
<br>
<form action="list.php" method="get">
    <select name="keyword">
        <option value='제목' name='title'>제목</option>
        <option value='내용' name='content'>내용</option>
        <option value='작성자' name='userName'>작성자</option>
        <option value='제목_내용' name='title_content'>제목+내용</option>
    </select>
    <input type="text" id="keyword_Text" name="searchText">
    <input type="submit" id="searchBtn" name="searchBtn" value="검색">
</form>
<br>
<br><button onclick="location.href='write.php'">글쓰기</button>&nbsp;
<?
if ($searchKeyword != null) {   // 검색을 한 경우에 버튼 보임
    echo "<button onclick=\"location.href='list.php'\">리스트</button>";
}
?>v
</body>
