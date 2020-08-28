<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?
echo "<h3>view 페이지 입니다.<br>";
require_once('write_process.php');

$pickTitleNum = $_GET['board_id'];  // list에서 받아온 게시판 id 값

// 조회수 증가
$hitUpSql  = "update mybulletin set hits = hits+1 where board_id={$pickTitleNum}";
$hitResult = $db_conn->query($hitUpSql);
if ($hitResult->errno > 0) {
    echo "조회수 증가 실패!";
    exit(-1);
}

$titleSql = "select * from mybulletin where board_id={$pickTitleNum}";
$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
$totalRowNum  = $selectResult->fetch_array();

$boardID     = $totalRowNum['board_id'];      // 글 번호
$userTitle   = $totalRowNum['title'];         // 제목
$userName    = $totalRowNum['user_name'];     // 작성자
$userDate    = $totalRowNum['reg_date'];      // 작성시간
$userHit     = $totalRowNum['hits'];          // 조회수
$userContent = $totalRowNum['contents'];      // content
?>
<fieldset style="width: 50%">
    <legend>
        글보기 글번호<?php echo $boardID; ?>
    </legend>
    <form action="modify.php" method="get">
        <table>
            <tr>
                <td>제목</td>
                <td><?php echo $userTitle; ?></td>
            </tr>
            <tr>
                <td>작성자</td><td><?php echo $userName; ?></td>
            </tr>
            <tr>
                <td>작성시간</td><td><?php echo $userDate; ?></td>
            </tr>
            <tr>
                <td>조회수</td><td><?php echo $userHit; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name='content' cols='80' rows='20' readonly><?php echo $userContent; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="list" value="글 목록" onclick="location.href='list.php'">
                    <input type="hidden" name="boardID" value="<?php echo $boardID; // 넘겨줄 게시글 번호 ?>">
                    <input type="submit" name="modify" value="글 수정" onclick="location.href='modify.php'">
                    <input type="button" name="delete" value="글 삭제"
                           onclick="location.href='delete.php?board_id=<?php echo $totalRowNum['board_id']; ?>'">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>










