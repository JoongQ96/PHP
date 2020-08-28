<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <?php
    // 글 목록 보기 - 작성된 글목록 페이지로 보기
    require_once('db_util.php');

    // 글 쓰기 dB에 저장
    if(isset($_POST['title']) && isset($_POST['writer']) && isset($_POST['password']) && isset($_POST['article'])) {
        if ($_POST['title'] == '' || $_POST['writer'] == '' || $_POST['password'] == '' || $_POST['article'] == '') {
            echo '<script>alert("공백이 있습니다.")</script>';
            echo '<script>location.href="list.php"</script>';
        } else {
            $db_conn = DB();
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $writer = htmlspecialchars($_POST['writer'], ENT_QUOTES);
            $password = password_hash(htmlspecialchars($_POST['password'], ENT_QUOTES), PASSWORD_DEFAULT);
            $article = htmlspecialchars($_POST['article'], ENT_QUOTES);

            $sql = "insert into mybulletin(`user_name`, `user_passwd`, `title`, `contents`, `reg_date`)
                        values ('$writer', '$password', '$title', '$article', now())";

            // query 실행 실패 시 출력
            if (!($db_conn->query($sql))) {
                echo "출력 실패";
                exit(-1);
            }
        }
    }

    function showArticle() {
        $db_conn = DB();

        $sql = "select * from mybulletin";

        // query 실행 실패 시 출력
        if (!($result = $db_conn->query($sql))) {
            echo "출력 실패";
            exit(-1);
        }
        return $result;
    }
    ?>
</head>
<body>
<?php
// 페이징을 위한 함수 구현
$db_conn = DB();
$rowTotal = showArticle()->num_rows;                   // 총 데이터 열의 갯수
$list_page = 3;                                        // 한 페이지 당 데이터 열의 수
$pageTotal = ceil($rowTotal/$list_page);         // 총 페이지 갯수
$page_where = 0;                                       // 페이지당 DB 데이터 몇번째에서 보여줄지
$now_page = isset($_GET['page'])? $_GET['page'] : 1;   // 현재 페이지

$block = 3;                                            // 블록은 3개씩
$blockTotal = ceil($pageTotal/$block);            // 총 블록
$nowBlock = ceil($now_page/$block);               // 현재 블록
$startPage = ($nowBlock * $block) - ($block - 1);       // 한 블록 당 시작 페이지
$endPage = $nowBlock * $block;                          // 한 블록 당 끝 페이지

// 한 블록 시작 페이지가 1보다 작음녀 1로 설정
if ($startPage <= 1) {
    $startPage = 1;
}
// 한 블록 끝 페이지가 마지막 페이지보다 크면 마지막 페이지로 설정
if ($pageTotal <= $endPage) {
    $endPage = $pageTotal;
}

// 총 데이터 갯수가 한 페이지 당 데이터 갯수보다 클 경우
if($rowTotal > $list_page){
    for($j = 1; $j < $now_page; $j++){
        $page_where += $list_page;
    }
    // 현재 페이지에 데이터 5개씩 표시
    $query = "select * from mybulletin where board_pid = 0 order by board_id desc limit $page_where, $list_page";
}

if(!($result = $db_conn->query($query))){
    echo "페이징 번호구현 실패";
    exit(-1);
}
?>
<table class = "prtData">
    <thead>
    <tr>
        <th colspan="5">신동협 게시판</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th class='th_class'>글 번호</th>
        <th class='th_class'>제목</th>
        <th class='th_class'>작성자</th>
        <th class='th_class'>조회수</th>
        <th class='th_class'>작성일</th>
    </tr>

    <?php
    while($row = $result->fetch_array()) {
        echo ("
                    <tr>
                        <td class='td_class' style='width: 10%'>$row[board_id]</td>
                        <td class='td_class' style='width: 30%'><a class = 'td_click' href=\"view.php?board_id=$row[board_id]\">$row[title]</a></td>
                        <td class='td_class'style='width: 20%'>$row[user_name]</td>
                        <td class='td_class'style='width: 10%'>$row[hits]</td>
                        <td class='td_class'style='width: 30%'>".date_format(date_create($row[reg_date]), 'Y-m-d')."</td>
                    </tr>
                ");
    }
    ?>
    <!--        <td class='td_class td_click' style='width: 30%'>$row[title]</td>-->
    </tbody>
</table>

<!-- 페이징 -->
<div id = 'page'>
    <?php
    if ($now_page <= $block) {
        echo '<span class="btn_page"><<</span>';
    } else {
        ?>
        <a class="btn_page btn_blockNext" href="<?=$PHP_SELP?>?page=<?=$startPage-1?>"><<</a>

        <?php
    }

    if ($now_page <= 1) {
        echo '<span class="btn_page"><</span>';
    } else {
        ?>
        <a class="btn_page btn_previousNext" href="<?=$PHP_SELP?>?page=<?=$now_page-1?>"><</a>

        <?php
    }
    for ($i=$startPage; $i<=$endPage; $i++) {
        if($i == $now_page) {
            ?>
            <span class="btn_page btn_page_now"><?=$i?></span>
            <?php
        } else {
            ?>

            <a class="btn_page" href="<?=$PHP_SELP?>?page=<?=$i?>"><?=$i?></a>

            <?php
        }
    }
    ?>

    <?php
    if ($now_page >= $pageTotal) {
        echo '<span class="btn_page">></span>';
    } else {
        ?>
        <a class="btn_page btn_previousNext" href="<?=$PHP_SELP?>?page=<?=$now_page+1?>">></a>
        <?php
    }

    // 4 5 6 -> 7 8 9 / 총 페이지가 9
    if ($endPage >= $pageTotal)
        echo '<span class="btn_page">>></span>';
    else {
        ?>
        <a class="btn_page btn_blockNext" href="<?=$PHP_SELP?>?page=<?=$endPage+1?>">>></a>
        <?php
    }
    ?>
</div>
<button id="writing" onclick="location.href='write.php'">글쓰기</button>
</body>
</html>