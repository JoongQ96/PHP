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
        /* first-child 부분 더 공부합시다. */
        /*.table th:first-child, .table td:first-child {*/
        /*    border-left: 0;*/
        /*}*/
        /*.table th:last-child, .table td:last-child {*/
        /*    border-right: 0;*/
        /*}*/
        /*.table tr td:first-child{*/
        /*    text-align: center;*/
        /*}*/
    </style>
    <?php
    require_once("write_process.php");
    echo "<h3>list 페이지 입니다.";
    ?>
</head>
<body>
</form>
<table class="table">
    <tr><th colspan="5">YC JUNG 게시판</th></tr>
    <tr>
        <td>번호</td>
        <td>제목</td>
        <td>작성자</td>
        <td>조회수</td>
        <td>날짜</td>
    </tr>
    <?php
    // 몇 페이지를 만들 것인지, 데이터 수에 따라서 출력되는 갯수가 다르니까
    // 몇 번째 버튼을 누를지 고른다 -> 버튼을 누른다->

    //                               row, 나타낼 글 수
    //  select * from mybulletin limit 0,5;

    //$pagingSql = "select * from mybulletin limit 0,5";
    //$pagingResult = $db_conn->query($pagingSql);
    //$count = $pagingResult->num_rows; // row 갯수

    // echo "row 갯수 : ".$count;

    $startPage = 0;
    $nowPage = "";

    if ($_GET['qwer'] == 1) {
        $pagingSql = "select * from mybulletin limit 0,5";
        $pagingResult = $db_conn->query($pagingSql);
//        $count = $pagingResult->num_rows; // row 갯수
        //$count = $pagingResult->fetch_array();


//        $sql = "select board_id, title, user_name, hits, reg_date from mybulletin";
//        $result = $db_conn->query($sql);


        echo "<table>";
        // 테이블 출력
        while ($count = $pagingResult->fetch_array()){
            //for ($i = 0; $i < $count; $i++){
            echo "<tr>";
            echo "<td>".$count['board_id']."</td>";
            echo "<td>".$count['title']."</td>";
            echo "<td>".$count['user_name']."</td>";
            echo "<td>".$count['hits']."</td>";
            echo "<td>".date_format(date_create($count['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }


    ?>
    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="get">
        <?php
        echo "<input type='hidden' name='qwer' value=1>
              <input type='submit' value='1'>";
        //    for ($i = 1; $i <= 10; $i++){
        //        echo "<tr>";
        //        echo "<td><input type='submit' value='  '></td>";
        //        echo "</tr>";
        //    }
        ?>
    </form>
    <?php
    $sql = "select board_id, title, user_name, hits, reg_date from mybulletin";
    $result = $db_conn->query($sql);


    // 테이블 출력
    while ($rowData = $result->fetch_array()){
        echo "<tr>";
        echo "<td>".$rowData['board_id']."</td>";
        echo "<td>".$rowData['title']."</td>";
        echo "<td>".$rowData['user_name']."</td>";
        echo "<td>".$rowData['hits']."</td>";
        echo "<td>".date_format(date_create($rowData['reg_date']),'Y-m-d')."</td>";
        echo "</tr>";
    }
    ?>
</table><br>
<button onclick="location.href='write.php'">글쓰기</button>
</body>
<?php
    echo "현재 총 게시글 갯수 : ".count($result->fetch_row());
?>
