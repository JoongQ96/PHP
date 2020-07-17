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

    $pagingSql        = "select * from mybulletin";
    $pagingResult     = $db_conn->query($pagingSql);
    $count            = $pagingResult->num_rows; // 현재 DB의 row 갯수
    $showTextNum      = 5;                       // 한 페이지 당 출력할 게시글 수
    $buttonNumCounter = floor($count/$showTextNum);        // 버튼 번호 갯수 = row 갯수/한 페이지 당 출력할 게시글 수

    echo "row 갯수 : ".$count."<br>";
    echo "한 페이지당 출력할 게시글 수 : ".$showTextNum."<br>";
    echo "버튼 번호 갯수 : ".$buttonNumCounter."<br>";

    $startPage = 1;   // default 페이지
    //$nowPage   = 0;   // 현재 페이지

    $clickPageButton = $_GET['nowPage'];
    echo "clickPageButton : ".$clickPageButton."<br>";

//    if (($clickPageButton-1)) { // 클릭한 버튼의 숫자를 받아옴
    if (isset($_GET['nowPage']) ) { // 클릭한 버튼의 숫자를 받아옴

        // 0 -> 0  1  2  3  4 : default
        // 1 -> 5  6  7  8  9
        // 2 -> 10 11 12 13 14
        // 3 -> 15 16 17 18 19

//        for ($i = 0; $i < $showTextNum; $i++){
//            //            ((클릭한 버튼 숫자 * 5) + $i)
//            $nowPages = ((($clickPageButton-1) * $showTextNum)  + $i);  // 클릭한 버튼 페이지의 첫 번째 글 count
//            echo "nowPage in for : ".$i."->".$nowPage."<br>";
//        }

        echo "nowPage : ".$nowPage."<br>";
        $nowPage = ($clickPageButton - 1) * $showTextNum;
        echo $nowPage;
        // 버튼 클릭 했을 경우의 페이지
        $pagingSql = "select * from mybulletin ORDER BY board_id desc limit {$nowPage},{$showTextNum}";
        $pagingResult = $db_conn->query($pagingSql);



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
    } else {
        // 시작 페이지

        $sql = "select * from mybulletin ORDER BY board_id desc limit 0,5"; // 시작 페이지, 버튼 1 눌렀을 때 페이지
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
    }
    ?>
</table>
    <?php
        // 페이지 버튼 출력
        for ($nowPage = 1; $nowPage < $buttonNumCounter+1; $nowPage++){
            echo "<tr><td>";
            if (isset($_GET['nowPage']) ) {
                if ($nowPage == $clickPageButton) {
                    echo "<input type='submit' value='$nowPage' name='nowPage' style='background: #00abeb'>";
                } else {
                    echo "<input type='submit' value='$nowPage' name='nowPage'>";
                }
            } else {
                if ($nowPage == 1) {
                    echo "<input type='submit' value='$nowPage' name='nowPage' style='background: #00abeb'>";
                } else {
                    echo "<input type='submit' value='$nowPage' name='nowPage'>";
                }
            }


            echo "</td></tr>";
        }
        echo  "ddddddd : ".$nowPage;
    ?>
</form>
<br>
<button onclick="location.href='write.php'">글쓰기</button>
</body>
