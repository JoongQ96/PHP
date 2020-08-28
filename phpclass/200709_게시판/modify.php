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
echo "<h3>modifty 페이지 입니다.<br>";
require_once('write_process.php');

$boardID = $_GET['boardID'];    // view에서 hidden으로 받아온 게시판 id 값

$titleSql = "select * from mybulletin where board_id={$boardID}";
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
$userPasswd  = $totalRowNum['user_passwd'];   // 기존의 비밀번호
$checkPasswd = "";                            // 입력 받기 위한 비밀번호
?>
<fieldset style="width: 50%">
    <legend>글보기 글번호<?php echo $boardID; ?></legend>
    <form action="modify_process.php" method="get">
        <table>
            <tr><td>제목</td><td><input type="text" value="<?php echo $userTitle; ?>" name="changeTitle"></td></tr>
            <tr><td>작성자</td><td><input type="text" value="<?php echo $userName; ?>" name="changeName"></td></tr>
            <tr><td>비밀번호</td><td><input type="text" value="<?php echo $checkPasswd; ?>" name="checkPasswd"></td></tr>
            <tr><td colspan="2"><textarea name='changeContent' cols='80' rows='20'><?php echo $userContent; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="list" value="글 목록" onclick="location.href='list.php'">
                    <input type="hidden" name="CheckBoardID" value="<?php echo $boardID; ?>">
                    <input type="submit" name="modify" value="글 수정" onclick="location.href='modify_process.php'">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>










