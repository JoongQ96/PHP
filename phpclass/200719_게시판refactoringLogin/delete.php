<?php require_once('db_conf.php'); echo "delete 파일<br>"; session_start(); ?>
<?php
$db_conn = dbConnection();
$boardID = $_GET['board_id'];            // view에서 받아온 게시판 id 값
$boardUserName = $_GET['boardUserName']; // 게시글 작성자 이름
?>
<?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
    <?php
    $goBackPage  = BoardInfo::FILENAME_LIST;                // 돌아갈 페이지 (list.php)
    message("잘못된 접근입니다.", $goBackPage);
    ?>
<?php else: ?>
<fieldset style="width: 50%">
    <legend>글삭제 글번호<?php echo $boardID; ?></legend>
    <form action="<?php echo BoardInfo::FILENAME_DELETE_PROCESS; ?>" method="post">
        <table>
            <tr><td>비밀번호</td>
                <td>
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="hidden" name="boardUserName" value="<?php echo $boardUserName; ?>">
                    <input type="hidden" name="userID" value="<?php echo $_SESSION['id']; ?>">
                    <input type="text"   name="checkPasswd">
                </td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="delete" value="글 삭제"></td></tr>
        </table>
    </form>
</fieldset>
<?php endif; ?>

