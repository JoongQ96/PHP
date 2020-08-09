<?php session_start(); ?>
<fieldset style="">
<?php if (1):?>
    <legend>로그인</legend>
    <form action="../controller/loginController.php" method="post">
        <table>
            <tr>
                <td>아  이  디</td><td><input type="text" name="id"></td>
            </tr>
            <tr>
                <td>비 밀 번 호</td>
                <td><input type="password" name="password"></td>
                <td><input type="submit" value="login"></td>
            </tr>
        </table>
    </form>
<?php else: ?>
    <form action="" method="post">
        <table>
            <tr><td>이름 : </td></tr>
            <tr><td><input type="submit" value="로그아웃" name="logout"></td></tr>
        </table>
    </form>
<?php endif; ?>
</fieldset>

