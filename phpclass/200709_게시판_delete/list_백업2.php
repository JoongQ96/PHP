
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
    <?php
    require_once("write_process.php");
    echo "<h3>list 페이지 입니다.";
    ?>
</head>
<body>
<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="get">
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
    $pagingSql         = "select * from mybulletin";
    $pagingResult      = $db_conn->query($pagingSql);
    $count             = $pagingResult->num_rows;            // 현재 DB의 row 갯수

    $showTextNum       = 5;                                  // 한 페이지 당 출력할 게시글 수
    $buttonNumCounter  = ($count/$showTextNum);              // 버튼 번호 갯수 = (row 갯수/한 페이지 당 출력할 게시글 수)
    $clickPageButton   = $_GET['nowPage'];                   // 클릭한 버튼으로부터 입력값 받아옴
    $showButtonCounter = 10;                                 // 한 페이지 당 출력할 버튼 수


    if (isset($_GET['nowPage']) ) {                         // 클릭한 버튼의 숫자를 받아옴
        // 버튼을 클릭 했을 때 실행됨
        $nowPage = ($clickPageButton - 1) * $showTextNum;   // 클릭한 버튼의 숫자를 연산, 출력할 row의 번호

        // 버튼 클릭 했을 경우의 페이지
        $pagingSql = "select * from mybulletin ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
        $pagingResult = $db_conn->query($pagingSql);

        // table 출력
        while ($count = $pagingResult->fetch_array()){
            echo "<tr>";
            echo "<td>".$count['board_id']."</td>";
            echo "<td>".$count['title']."</td>";
            echo "<td>".$count['user_name']."</td>";
            echo "<td>".$count['hits']."</td>";
            echo "<td>".date_format(date_create($count['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
    } else {
        // default 페이지
        $sql = "select * from mybulletin ORDER BY board_id desc limit 0,5";
        $result = $db_conn->query($sql);

        // table 출력
        while ($rowData = $result->fetch_array()){
            echo "<tr>";
            echo "<td>".$rowData['board_id']."</td>";
            echo "<td>".$rowData['title']."</td>";
            echo "<td>".$rowData['user_name']."</td>";
            echo "<td>".$rowData['hits']."</td>";
            echo "<td>".date_format(date_create($rowData['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
    <?php
        // 전체 페이지 버튼 수           $buttonNumCounter  - 31
        // 한 페이지당 출력할 버튼 수     $showButtonCounter - 10
        // 현재 페이지 클릭된 버튼        $clickPageButton

        // 출력할 버튼 블록 카운터 수 연산 $buttonBlockCounter
        if ($buttonNumCounter%$showButtonCounter == 0) {
            $buttonBlockCounter = ceil($buttonNumCounter%$showButtonCounter);
        } else {
            $buttonBlockCounter = (ceil($buttonNumCounter%$showButtonCounter) + 1); // 나머지가 0이 아닌 경우
        }

        for ($nowPage = 1; $nowPage <= $buttonBlockCounter; $nowPage++){
            if($nowPage != 1) {
                // << 출력
                echo "<input type='submit' value='<<' name='buttonBlockCounter'>";
            } else {
                echo "<button><<</button>"; // default인 경우 클릭해도 변화 x
            }
        }


        // 페이지 버튼 출력, 선택된 버튼 컬러 추가
        for ($nowPage = 1; $nowPage <= $buttonNumCounter; $nowPage++){
            if (isset($_GET['nowPage']) ) {     // 클릭된 페이지
                if ($nowPage == $clickPageButton) {
                    echo "<input type='submit' value='$nowPage' name='nowPage' style='background: red'>";
                } else {
                    echo "<input type='submit' value='$nowPage' name='nowPage'>";
                }
            } else {
                if ($nowPage == 1) {            // default 페이지
                    echo "<input type='submit' value='$nowPage' name='nowPage' style='background: red'>";
                } else {
                    echo "<input type='submit' value='$nowPage' name='nowPage'>";
                }
            }
        }






    ?>
</form>
<br>
<button onclick="location.href='write.php'">글쓰기</button>
</body>
