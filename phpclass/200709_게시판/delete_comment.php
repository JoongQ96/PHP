<?php
echo "<h3>delete comment 페이지 입니다.<br>";
require_once('write_process.php');
// view의 덧글 삭제 버튼에서 받아온 값들
$boardID             = $_GET['boardID'];             // 게시판 id 값
$commentUserId       = $_GET['commentUserID'];       // 덧글 id 값
$commentUserName     = $_GET['commentUserName'];     // 덧글 작성자 이름
$commentUserContents = $_GET['commentUserContents']; // 덧글 내용
$commentUserDate     = $_GET['commentUserDate'];     // 덧글 쓴 날짜
$nowPage             = $_GET['nowPage'];

$titleSql = "select * from mybulletin where board_id={$commentUserId}";
$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
?>
<fieldset style="width: 50%">
    <legend>덧글삭제 덧글번호<?php echo $commentUserId; ?></legend>
    <form action="delete_comment_process.php" method="get">
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
























