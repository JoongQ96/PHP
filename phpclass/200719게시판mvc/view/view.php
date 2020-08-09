<?php
session_start();
require_once ('../model/boardModel.php');
require_once ('../controller/library.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);


$pickTitleNum = $_GET['board_id'];  // list에서 받아온 게시판 글 번호
//echo "ddd : ".$pickTitleNum;
$obj = new board_Query();
///////////////////////////////////////////////////////////////////////
// 조회수 증가 함수
$obj->hitUp($pickTitleNum);
///////////////////////////////////////////////////////////////////////




// 선택한 게시글 쿼리 함수
$totalRowNum  = $obj->selectBoardCalculation($pickTitleNum);
$boardID      = $totalRowNum['board_id'];      // 글 번호
$userTitle    = $totalRowNum['title'];         // 글 제목
$userName     = $totalRowNum['user_name'];     // 작성자
$userDate     = $totalRowNum['reg_date'];      // 작성 시간
$userHit      = $totalRowNum['hits'];          // 조회수
$userContent  = $totalRowNum['contents'];      // 글 내용

///////////////////////////////////////////////////////////////////////
$searchKeyword = $_GET['keyword'];     // 검색 option 선택 keyword
$searchText    = $_GET['searchText'];  // 검색 내용
$searchBtn     = $_GET['searchBtn'];   // 검색 버튼 누른 것에 대한 값

///////////////////////////////////////////////////////////////////////
$nowPage       = $_GET['nowPage'];    // list의 페이징 된 버튼을 클릭한 경우 페이지 번호


?>
<fieldset style="width: 50%">
    <legend>
        글보기 글번호<?php echo $boardID; ?>
    </legend>
    <!-- list에서 선택한 게시글 출력 -->
    <form action="modify.php" method="post">
        <table>
            <tr><td>제목</td><td><?php echo $userTitle; ?></td></tr>
            <tr><td>작성자</td><td><?php echo $userName; ?></td></tr>
            <tr><td>작성시간</td><td><?php echo $userDate; ?></td></tr>
            <tr><td>조회수</td><td><?php echo $userHit; ?></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20' readonly><?php echo $userContent; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <?php
                    if ($searchKeyword != null){    // list에서 검색 한 경우
                        echo "<input type='button' name='list' value='글 목록' 
                              onclick=\"location.href='list.php?board_id={$boardID}&keyword={$searchKeyword}&searchText={$searchText}&searchBtn={$searchBtn}&nowPage={$nowPage}'\">";
                    } else{
                        if ($nowPage != null){      // list에서 검색 안한 경우, nowPage 있을때
                            echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='list.php?nowPage={$nowPage}'\">";
                        } else{                     // list에서 검색 안한 경우, nowPage 없을때, 즉 default page
                            echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='list.php?nowPage=1'\">";
                        }
                    }
                    ?>
                    <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                    <input type="hidden" name="boardUserName" value="<?php echo $userName; ?>">
                    <?php if ($_SESSION['id'] == $userName): ?>
                        <input type="submit" name="modify" value="글 수정" id="modify"
                               onclick="location.href='modify.php'">
                        <input type="button" name="delete" value="글 삭제" id="delete"
                               onclick="location.href='delete.php?board_id=<?php echo $pickTitleNum; ?>'">
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>

    <br><br>
    <?php if (isset($_SESSION['id'])): // login 한 경우 ?>
        <!-- 덧글 작성, login 한 사람만 작성 가능 -->
        <form action="" method="post">
            <table>
                <tr><td>댓글</td></tr>
                <tr>
                    <td>작성자</td>
                    <td>
                        <?php echo $_SESSION['id']; ?>
                        <input type="hidden" name="name" value="<?php echo $_SESSION['id']; ?>">
                    </td>
                </tr>
                <tr><td>코멘트</td><td><input type="text" name="content"></td></tr>
                <tr>
                    <td>
                        <input type="hidden" name="password" value="<?php echo $_SESSION['password']; ?>">
                        <input type="hidden" name="pid" value="<?php echo $boardID; ?>">
                        <input type="hidden" name="CheckNowPage" value="<?php echo $nowPage; ?>">
                        <input type="submit" value="덧글쓰기">
                    </td>
                </tr>
            </table>
        </form>
    <?php endif; ?>
    <br><br>
    <!-- 덧글 출력 -->
    <form action="" method="post">
        <table>
            <tr><td>작성자</td><td>코멘트</td><td>작성일</td><td>삭제</td></tr>
            <? //showComment($boardID, $nowPage); // 덧글 출력 기능 (게시글 번호, 현재 페이지 번호) ?>
        </table>
    </form>

</fieldset>