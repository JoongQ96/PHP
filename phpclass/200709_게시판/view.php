<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?
echo "<h3>view 페이지 입니다.<br>";
require_once('write_process.php');

$pickTitleNum = $_GET['board_id'];  // list에서 받아온 게시판 id 값

// 조회수 증가
$hitUpSql  = "update mybulletin set hits = hits+1 where board_id={$pickTitleNum}";
$hitResult = $db_conn->query($hitUpSql);
if ($hitResult->errno > 0) {
    echo "조회수 증가 실패!";
    exit(-1);
}
// 선택한 게시글의 쿼리
$titleSql = "select * from mybulletin where board_id={$pickTitleNum}";
$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
$totalRowNum  = $selectResult->fetch_array();

$boardID     = $totalRowNum['board_id'];      // 글 번호
$userTitle   = $totalRowNum['title'];         // 제목
$userName    = $totalRowNum['user_name'];     // 작성자
$userDate    = $totalRowNum['reg_date'];      // 작성시간
$userHit     = $totalRowNum['hits'];          // 조회수
$userContent = $totalRowNum['contents'];      // content
///////////////////////////////////////////////////////////////////////

$searchKeyword = $_GET['keyword'];     // option 선택 keyword
$searchText    = $_GET['searchText'];  // 검색 내용
$searchBtn     = $_GET['searchBtn'];   // 검색 버튼 누른 것에 대한 값
////////////////////////////////////////
$nowPage = $_GET['nowPage'];
?>
<fieldset style="width: 50%">
    <legend>
        글보기 글번호<?php echo $boardID; ?>
    </legend>
    <form action="modify.php" method="get">
        <table>
            <tr><td>제목</td><td><?php echo $userTitle; ?></td></tr>
            <tr><td>작성자</td><td><?php echo $userName; ?></td></tr>
            <tr><td>작성시간</td><td><?php echo $userDate; ?></td></tr>
            <tr><td>조회수</td><td><?php echo $userHit; ?></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20' readonly><?php echo $userContent; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <?php
                        if ($searchKeyword != null){    // 검색 한 경우
                            echo "<input type='button' name='list' value='글 목록' 
                            onclick=\"location.href='list.php?board_id={$boardID}&keyword={$searchKeyword}&searchText={$searchText}&searchBtn={$searchBtn}&nowPage={$nowPage}'\">";
                        } else{
                            if ($nowPage != null){      // 검색 안한 경우, nowPage 있을때
                                echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='list.php?nowPage={$nowPage}'\">";
                            } else{                     // 검색 안한 경우, nowPage 없을때, 즉 default page
                                echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='list.php'\">";
                            }
                        }
                    ?>
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="submit" name="modify" value="글 수정" id="modify" onclick="location.href='modify.php'">
                    <input type="button" name="delete" value="글 삭제" id="delete" onclick="location.href='delete.php?board_id=<?php echo $totalRowNum['board_id']; ?>'">
                </td>
            </tr>
        </table>
    </form>
    <br><br>
    <form action="write_comment_process.php" method="get">
        <table>
            <tr><td>댓글</td></tr>
            <tr><td>작성자</td><td><input type="text" name="commentUser"></td></tr>
            <tr><td>코멘트</td><td><input type="text" name="commentContent"></td></tr>
            <tr><td>비밀번호</td><td><input type="text" name="commentPw"></td></tr>
            <tr>
                <td>
                    <input type="hidden" name="CheckBoardID" value="<?php echo $boardID; ?>">
                    <input type="hidden" name="CheckNowPage" value="<?php echo $nowPage; ?>">
                    <input type="submit" value="덧글쓰기">
                </td>
            </tr>
        </table>
    </form>
    <br><br>
    <form action="delete_comment.php" method="get">
    <table>
        <tr><td>작성자</td><td>코멘트</td><td>작성일</td><td>삭제</td></tr>
        <?
        // 덧글 출력 기능
        $commentViewSql = "select * from mybulletin where board_pid = $boardID;";
        $resultCommentViewSql = $db_conn->query($commentViewSql);

        // 덧글 출력
        while ($commentView = $resultCommentViewSql->fetch_array()){
            echo "<tr>";
            echo "<td>".$commentView['user_name']."</td>";
            echo "<td>".$commentView['contents']."</td>";
            echo "<td>".$commentView['reg_date']."</td>";
            ?>
            <input type="hidden" name="nowPage" value="<?php echo $nowPage; ?>">
            <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
            <input type="hidden" name="commentUserID" value="<?php echo $commentView['board_id']; ?>">
            <input type="hidden" name="commentUserName" value="<?php echo $commentView['user_name']; ?>">
            <input type="hidden" name="commentUserContents" value="<?php echo $commentView['contents']; ?>">
            <input type="hidden" name="commentUserDate" value="<?php echo $commentView['reg_date']; ?>">
            <?
            echo "<td><input type='submit' name='deleteComment' value='삭제'></td>";
            echo "</tr>";
        }
        ?>
    </table>
    </form>
</fieldset>
</body>
</html>










