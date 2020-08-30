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
<fieldset style="width: 50%">
    <legend>글보기 글번호<?php echo $boardValue->board_id; ?></legend>
    <form action="<?php echo BoardInfo::FILENAME_MODIFY_PROCESS; ?>" method="post">
        <table>
            <tr><td>제목</td><td><input type="text" value="<?php echo $boardValue->title; ?>" name="title"></td></tr>
            <tr>
                <td>작성자</td>
                <td>
                    <?php echo $_SESSION['id']; ?>
                    <input type="hidden" name="name" value="<?php echo $_SESSION['id']; ?>">
                </td>
            </tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20'><?php echo $boardValue->contents; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="list" value="글 목록" onclick="location.href='<?php echo BoardInfo::FILENAME_MAIN; ?>'">
                    <input type="hidden" name="CheckBoardID" value="<?php echo $boardValue->board_id;?>">
                    <input type="submit" name="modify" value="글 수정">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>