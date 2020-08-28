<?php require_once('db_conf.php'); echo "delete 파일<br>"; ?>
<?php
$db_conn = dbConnection();
$boardID = $_GET['board_id'];    // view에서 받아온 게시판 id 값
?>
<fieldset style="width: 50%">
    <legend>글삭제 글번호<?php echo $boardID; ?></legend>
    <form action="<?php echo BoardInfo::FILENAME_DELETE_PROCESS; ?>" method="get">
        <table>
            <tr><td>비밀번호</td>
                <td>
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="text"   name="checkPasswd">
                </td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="delete" value="글 삭제"></td></tr>
        </table>
    </form>
</fieldset>
