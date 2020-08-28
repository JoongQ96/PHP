<?php require_once('db_conf.php'); echo "delete_comment 파일<br>"; ?>
<?php
$db_conn = dbConnection();
// view의 덧글 삭제 버튼에서 받아온 값들
$boardID             = $_POST['boardID'];             // 게시판 id 값
$commentUserId       = $_POST['commentUserID'];       // 덧글 id 값
$nowPage             = $_POST['nowPage'];
selectBoardCalculation($commentUserId);
?>
<fieldset style="width: 50%">
    <legend>덧글삭제 덧글번호<?php echo $commentUserId; ?></legend>
    <form action="delete_comment_process.php" method="post">
        <table>
            <tr>
                <td>비밀번호</td>
                <td>
                    <input type="hidden" name="nowPage" value="<?php echo $nowPage; ?>">
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="hidden" name="commentBoardID" value="<?php echo $commentUserId; ?>">
                    <input type="text" name="userInputPasswd">
                </td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="delete" value="덧글 삭제"></td></tr>
        </table>
    </form>
</fieldset>

