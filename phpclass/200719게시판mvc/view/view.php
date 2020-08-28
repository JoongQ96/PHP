<fieldset style="width: 50%">
    <legend>글보기 글번호<?php echo $boardValue->board_id; ?></legend>
    <!-- list에서 선택한 게시글 출력 -->
    <form action="../controller/modifyController.php" method="post">
        <table>
            <tr><td>제목</td><td><?php echo $boardValue->title; ?></td></tr>
            <tr><td>작성자</td><td><?php echo $boardValue->user_name; ?></td></tr>
            <tr><td>작성시간</td><td><?php echo $boardValue->reg_date; ?></td></tr>
            <tr><td>조회수</td><td><?php echo $boardValue->hits; ?></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20' readonly><?php echo $boardValue->contents; ?></textarea></td></tr>
            <tr>
                <td colspan="2">
                    <?php
                    if ($searchKeyword != null){    // list에서 검색 한 경우
                        echo "<input type='button' name='list' value='글 목록' 
                              onclick=\"location.href='../view/main.php?board_id={$boardValue->board_id}&keyword={$searchKeyword}&searchText={$searchText}&searchBtn={$searchBtn}&nowPage={$nowPage}'\">";
                    } else{
                        if ($nowPage != null){      // list에서 검색 안한 경우, nowPage 있을때
                            echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='../view/main.php?nowPage={$nowPage}'\">";
                        } else{                     // list에서 검색 안한 경우, nowPage 없을때, 즉 default page
                            echo "<input type='button' name='list' value='글 목록' onclick=\"location.href='../view/main.php?nowPage=1'\">";
                        }
                    }
                    ?>
                    <input type="hidden" name="boardID" value="<?php echo $boardValue->board_id; ?>">
                    <input type="hidden" name="boardUserName" value="<?php echo $boardValue->user_name; ?>">
                    <?php if ($_SESSION['id'] == $boardValue->user_name): ?>
                        <input type="submit" name="modify" value="글 수정" id="modify"
                               onclick="location.href='../controller/modifyController.php'">
                        <input type="button" name="delete" value="글 삭제" id="delete"
                               onclick="location.href='../controller/deleteController.php?board_id=<?php echo $pickTitleNum; ?>'">
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>

    <br><br>
    <?php if (isset($_SESSION['id'])): // login 한 경우 ?>
        <!-- 덧글 작성, login 한 사람만 작성 가능 -->
        <form action="../controller/writeProcess.php" method="post">
            <table>
                <tr><td>댓글</td></tr>
                <tr>
                    <td>작성자</td>
                    <td>
                        <?php echo $_SESSION['id']; ?>
                    </td>
                </tr>
                <tr><td>코멘트</td><td><input type="text" name="content"></td></tr>
                <tr>
                    <td>
                        <input type="hidden" name="newComment" value="newComment">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="password" value="<?php echo $_SESSION['password']; ?>">
                        <input type="hidden" name="pid" value="<?php echo $boardValue->board_id; ?>">
                        <input type="hidden" name="CheckNowPage" value="<?php echo $nowPage; ?>">
                        <input type="submit" value="덧글쓰기">
                    </td>
                </tr>
            </table>
        </form>
    <?php endif; ?>
    <br><br>
    <!-- 덧글 출력 -->
    <form action="../controller/deleteProcess.php" method="post">
        <table>
            <tr><td>작성자</td><td>코멘트</td><td>작성일</td><td>삭제</td></tr>
            <input type="hidden" name="delComment" value="delComment">
            <input type="hidden" name="boardID" value="<?php echo $boardValue->board_id; ?>">
            <input type="hidden" name="nowPage" value="<?php echo $nowPage; ?>">
            <? $obj->showComment($boardValue->board_id); // 덧글 출력 기능 (게시글 번호, 현재 페이지 번호) ?>
        </table>
    </form>

</fieldset>