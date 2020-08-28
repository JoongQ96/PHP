<?php
echo "<h3>delete 페이지 입니다.<br>";
require_once('write_process.php');

$boardID = $_GET['board_id'];    // view에서 받아온 게시판 id 값

$titleSql = "select * from mybulletin where board_id={$pickTitleNum}";

$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
//echo "boardID : ".$boardID."<br>";
?>
<fieldset style="width: 50%">
    <legend>
        글삭제 글번호<?php echo $boardID; ?>
    </legend>
    <form action="delete_process.php" method="get">
        <table>
            <tr>
                <td>비밀번호</td>
                <td><input type="text" name="userInputPasswd"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="delete" value="글 삭제">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>
























