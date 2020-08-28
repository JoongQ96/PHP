
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
    echo "<h3>list 페이지 입니다.<br>";
    ?>
</head>
<body>
<form action="view.php" method="get">
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
    $totalRowNum       = $pagingResult->num_rows;                           // 전체 row 갯수
    $showTextNum       = 5;                                                 // 한 페이지 당 출력할 게시글 수
    $totalPageNum      = ceil($totalRowNum/$showTextNum);              // 전체 페이지 수

    $clickPageButton   = isset($_GET['nowPage'])? $_GET['nowPage']: 1;      // 클릭한 버튼으로부터 입력값 받아옴

    $showButtonNum = 10;                                                    // 블럭당 출력할 버튼 수
    $totalBlock    = ceil($totalPageNum/$showButtonNum);               // 총 블럭 수
    $nowBlockNum   = ceil($clickPageButton/$showButtonNum);            // 현재 블록 number

    $startPageNum = ($nowBlockNum * $showButtonNum) - ($showButtonNum - 1); // 보여줄 블록의 첫번째 버튼
    $endPageNum   = $nowBlockNum * $showButtonNum;                          // 보여줄 블록의 마지막 버튼

    // 보여줄 블록의 첫번째 버튼 번호가 1보다 작거나 같은 경우 1로 설정
    if ($startPageNum <= 1){
        $startPageNum = 1;
    }
    // 보여줄 블록의 마지막 버튼 번호가 마지막 버튼 번호와 크거나 같은 경우 마지막 페이지로 설정
    if ($totalPageNum <= $endPageNum) {
        $endPageNum = $totalPageNum;
    }


    if (isset($_GET['nowPage']) ) {                         // 클릭한 버튼의 숫자를 받아옴
        // 버튼을 클릭 했을 때 실행됨
        $nowPage = ($clickPageButton - 1) * $showTextNum;   // 클릭한 버튼의 숫자를 연산, 출력할 row의 번호
        // 버튼 클릭 했을 경우의 페이지
        $pagingSql = "select * from mybulletin ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
        $pagingResult = $db_conn->query($pagingSql);

        // table 출력
        while ($totalRowNum = $pagingResult->fetch_array()){
            echo "<tr>";
            echo "<td>".$totalRowNum['board_id']."</td>";
            echo "<td><a href='view.php?board_id={$totalRowNum['board_id']}'>".$totalRowNum['title']."</a></td>";
            echo "<td>".$totalRowNum['user_name']."</td>";
            echo "<td>".$totalRowNum['hits']."</td>";
            echo "<td>".date_format(date_create($totalRowNum['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
    } else {
        // default 페이지
        $sql = "select * from mybulletin ORDER BY board_id desc limit 0,5";
        $result = $db_conn->query($sql);

        // table 출력
        while ($totalRowNum = $result->fetch_array()){
            echo "<tr>";
            echo "<td>".$totalRowNum['board_id']."</td>";
            echo "<td><a href='view.php?board_id={$totalRowNum['board_id']}'>".$totalRowNum['title']."</a></td>";
            echo "<td>".$totalRowNum['user_name']."</td>";
            echo "<td>".$totalRowNum['hits']."</td>";
            echo "<td>".date_format(date_create($totalRowNum['reg_date']),'Y-m-d')."</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
</form>
<div>
    <?php
    // << 기능
    if ($clickPageButton <= 1){     // 현재 클릭된 블록 안의 버튼이 1인 경우
        echo "<span><<</span>";
    } else{                         // 현재 클릭된 블록 안의 버튼이 1이 아닌 경우
        ?>
        <a href="<?php echo $_SERVER[PHP_SELF]; ?>?nowPage=<?php echo $clickPageButton-1; ?>"><<</a>
        <?php
    }
    // 버튼 출력
    for ($num = ($startPageNum); $num <= $endPageNum; $num++){
        if ($num == $clickPageButton){      // 클릭된 블록 안의 숫자의 경우
            ?>
            <span  style="color: red"><?php echo $num; ?></span>
            <?php
        } else{                             // 클릭되지 않은 블록 안의 숫자의 경우
            ?>
            <a href="<?php echo $_SERVER[PHP_SELF]; ?>?nowPage=<?php echo $num; ?>"><?php echo $num; ?></a>
            <?php
        }
    }
    // >> 기능
    if ($clickPageButton >= $totalPageNum){     // 현재 클릭된 블록 안의 버튼이 버튼의 마지막 값인 경우
        echo "<span>>></span>";
    } else{                                     // 현재 클릭된 블록 안의 버튼이 버튼의 마지막 값이 아닌 경우
        ?>
        <a href="<?php echo $_SERVER[PHP_SELF]; ?>?nowPage=<?php echo $clickPageButton+1;?>">>></a>
        <?php
    }
    ?>
</div>
<br>
<br><button onclick="location.href='write.php'">글쓰기</button>
</body>
