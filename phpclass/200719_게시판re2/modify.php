<?php require_once('db_conf.php'); echo "modify 파일<br>"; ?>
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
$db_conn = dbConnection();
$boardID = $_GET['boardID'];    // view에서 받아온 게시판 id 값
///////////////////////////////////////////////////////////////////////
// 선택한 게시글 쿼리 함수
$totalRowNum = selectBoardCalculation($boardID);
$boardID     = $totalRowNum['board_id'];      // 글 번호
$userTitle   = $totalRowNum['title'];         // 글 제목
$userName    = $totalRowNum['user_name'];     // 작성자
$userContent = $totalRowNum['contents'];      // 글 내용
$userPasswd  = $totalRowNum['user_passwd'];   // 기존의 비밀번호
$checkPasswd = "";                            // 수정시 입력용 비밀번호
?>
<fieldset style="width: 50%">
    <legend>글보기 글번호<?php echo $boardID; ?></legend>
    <form action="modify_process.php" method="get">
        <table>
            <tr><td>제목</td><td><input type="text" value="<?php echo $userTitle; ?>" name="title"></td></tr>
            <tr><td>작성자</td><td><input type="text" value="<?php echo $userName; ?>" name="name"></td></tr>
            <tr><td>비밀번호</td><td><input type="text" value="<?php echo $checkPasswd; ?>" name="checkPasswd"></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20'><?php echo $userContent; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="list" value="글 목록" onclick="location.href='<?php echo BoardInfo::FILENAME_LIST; ?>'">
                    <input type="hidden" name="CheckBoardID" value="<?php echo $boardID; ?>">
                    <input type="submit" name="modify" value="글 수정" onclick="location.href='<?php echo BoardInfo::FILENAME_MODIFY_PROCESS; ?>'">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>


