<?php
    session_start();
    require_once ('../model/boardModel.php');
    require_once ('../controller/library.php');

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
    <?php
    $goBackPage  = "main.php";                // 돌아갈 페이지 (list.php)
    message("잘못된 접근입니다.", $goBackPage);
    ?>
<?php else: ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?
$boardID     = $_POST['boardID'];             // view에서 받아온 게시판 id 값
$obj         = new board_Query();
$boardValue  = $obj->selectBoardId($boardID);
$checkPasswd = "";                            // 수정시 입력용 비밀번호
?>
<fieldset style="width: 50%">
    <legend>글보기 글번호<?php echo $boardValue->board_id; ?></legend>
    <form action="modify_process.php" method="post">
        <table>
            <tr><td>제목</td><td><input type="text" value="<?php echo $boardValue->title; ?>" name="title"></td></tr>
            <tr>
                <td>작성자</td>
                <td>
                    <?php echo $_SESSION['id']; ?>
                    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="name">
                </td>
            </tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20'><?php echo $boardValue->contents; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="list" value="글 목록" onclick="location.href='main.php'">
                    <input type="hidden" name="CheckBoardID" value="<?php echo $boardValue->board_id; ?>">
                    <input type="hidden" name="thisUserName" value="<?php echo $boardValue->usr_name?>">
                    <input type="submit" name="modify" value="글 수정" onclick="location.href=''">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>
<?php endif; ?>