<fieldset style="width: 50%">
    <legend>글삭제 글번호<?php echo $boardID; ?></legend>
    <form action="../controller/deleteProcess.php" method="post">
        <table>
            <tr>
                <td>비밀번호</td>
                <td>
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="hidden" name="userID" value="<?php echo $_SESSION['id']; ?>">
                    <input type="text" name="checkPasswd">
                </td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="delete" value="글 삭제"></td></tr>
        </table>
    </form>
</fieldset>