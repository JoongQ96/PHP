<?php
// 회원가입 페이지
require_once('db_conf.php');
?>

<form action="newAccount_process.php" method="get">
    <table>
        <tr>
            <th>
                I    D
            </th>
            <td>
                <input type="text" name="id">
            </td>
        </tr>
        <tr>
            <th>
                비밀번호
            </th>
            <td>
                <input type="text" name="password">
            </td>
        </tr>
        <tr>
            <th>
                이   름
            </th>
            <td>
                <input type="text" name="name">
                <input type="submit" value="가입하기">
            </td>
        </tr>
    </table>
</form>
<?php




?>