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
<!------------------------------------------- 로그인 ------------------------------------------------------------------->
<?php
session_start();
if (isset($_POST['logout'])) { // -> isset : 선언o, null값 x 인 경우 true
    // 새로고침 할 경우 세션이 종료를 방지
    // logout 세션이 있는 경우
    $_SESSION = array();
    session_destroy();
}
?>
<fieldset style="width: 30%">
<?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
    <form action="result.php" method="post">
        <table>
            <tr><th>I D :</th><td><input type="text" name="id"></td></tr>
            <tr><th>암호 :</th><td><input type="text" name="password"></td></tr>
            <tr><td><input type="submit" value="로그인하기"></td></tr>
        </table>
    </form>
<?php else: ?>
    <form action="<?php echo $_SERVER[PHP_SELF]; // login 한 경우 ?>" method="post">
        <table>
            <tr><td><?php echo "이 름 : ".$_SESSION['name']; ?></td></tr>
            <tr><td><input type="submit" value="로그아웃" name="logout"></td></tr>
        </table>
    </form>
<?php endif; ?>
</fieldset>
<!------------------------------------------- 게시판 ------------------------------------------------------------------->
<form action="<?php echo BoardInfo::FILENAME_VIEW; ?>" method="get">
    <table class="table">
        <tr><th colspan="5">YC JUNG 게시판</th></tr>
        <tr style="border: #2b303b"><td>번호</td><td>제목</td><td>작성자</td><td>조회수</td><td>날짜</td></tr>
        <?php

        $clickPageButton   = isset($_GET['nowPage'])? $_GET['nowPage']: 1;      // 클릭한 버튼의 입력값 받아옴

        // 리스트 출력 연산을 위한 함수
        $db_conn       = dbConnection();
        $pagingSql     = "select * from mybulletin where board_pid = 0";
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

        // 리스트 출력 함수, $changeSql 반환
        $changeSql = listQuery($clickPageButton, $showTextNum, $searchKeyword, $searchText);
        ?>
        <input type="hidden" name="thisPage" value="<?php echo $clickPageButton; ?>">
    </table>
</form>
<?
// 검색후 페이징 기능, 버튼의 숫자 조절
if ($searchKeyword != null){            // 검색을 한 경우
    $pagingSql         = $changeSql;    // 쿼리 변경
    $pagingResult      = $db_conn->query($pagingSql);
    $totalRowNum       = $pagingResult->num_rows;                           // 전체 row 갯수
    $totalPageNum      = ceil($totalRowNum/$showTextNum);              // 전체 페이지 수
}
// 보여줄 블록의 첫번째 버튼 번호가 1보다 작거나 같은 경우 1로 설정
if ($startPageNum <= 1){ $startPageNum = 1; }
// 보여줄 블록의 마지막 버튼 번호가 마지막 버튼 번호와 크거나 같은 경우 마지막 페이지로 설정
if ($totalPageNum <= $endPageNum) { $endPageNum = $totalPageNum; }
?>
<div>
    <?php
    // button 기능
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($searchKeyword == null) {       // 검색을 안한 경우
        // << 기능
        if ($clickPageButton <= $showButtonNum){
            echo "<span><<</span>";
        } else {
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $startPageNum-1; ?>"><<</a>
            <?
        }
        // < 기능
        if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, < 클릭 불가
            echo "<span><</span>";
        } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, < 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $clickPageButton-1; ?>"><</a>
            <?php
        }
        // 버튼 출력
        for ($num = $startPageNum; $num <= $endPageNum; $num++){
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
        // > 기능
        if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, > 클릭 불가
            echo "<span>></span>";
        } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, > 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $clickPageButton+1; ?>">></a>
            <?php
        }
        // >> 기능
        if ($endPageNum >= $totalPageNum){
            echo "<span>>></span>";
        } else {
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $endPageNum+1; ?>">>></a>
            <?
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    else {                              // 검색을 한 경우
        // << 기능
        if ($clickPageButton <= $showButtonNum){
            echo "<span><<</span>";
        } else {
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?nowPage=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $startPageNum-1; ?>"><<</a>
            <?
        }
        // < 기능
        if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, < 클릭 불가
            echo "<span><</span>";
        } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, < 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $clickPageButton-1; ?>"><</a>
            <?php
        }
        // 버튼 출력
        for ($num = $startPageNum; $num <= $endPageNum; $num++){
            if ($num == $clickPageButton){      // 출력된 블록 안의 클릭된 숫자의 경우, 클릭 불가
                ?>
                <span  style="color: red"><?php echo $num; ?></span>
                <?php
            } else{                             // 출력된 블록 안의 클릭되지 않은 숫자의 경우, 클릭 가능
                ?>
                <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $num; ?>"><?php echo $num; ?></a>
                <?php
            }
        }
        // > 기능
        if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, > 클릭 불가
            echo "<span>></span>";
        } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, > 클릭 가능
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $clickPageButton+1; ?>">></a>
            <?php
        }
        // >> 기능
        if ($endPageNum >= $totalPageNum){
            echo "<span>>></span>";
        } else {
            ?>
            <a href="<?php echo BoardInfo::FILENAME_LIST; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $endPageNum+1; ?>">>></a>
            <?
        }
    }
    ?>
</div>
<br>
<br>
<form action="<?php echo BoardInfo::FILENAME_LIST; ?>" method="get">
    <select name="keyword">
        <option value='제목' name='title'>제목</option>
        <option value='내용' name='content'>내용</option>
        <option value='작성자' name='userName'>작성자</option>
        <option value='제목_내용' name='title_content'>제목+내용</option>
    </select>
    <input type="text" id="keyword_Text" name="searchText">
    <input type="submit" id="searchBtn" name="searchBtn" value="검색">
</form>
<br><br>
<?php if(isset($_SESSION['id'])): // 로그인 한 경우에 버튼 출력 ?>
    <form action="<?php echo BoardInfo::FILENAME_WRITE; ?>" method="post">
        <input type="hidden" name="userID" value="<?php echo $_SESSION['id']; ?>">
        <input type="submit" value="글쓰기">
    </form>
<?php endif; ?>

<?php if ($searchKeyword != null): // 검색을 한 경우에 버튼 출력 ?>
<button onclick="location.href='list.php'">리스트</button>
<?php endif; ?>
</body>
