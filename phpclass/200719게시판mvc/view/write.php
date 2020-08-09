<?php session_start(); ?>
<?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
    <?php
    $goBackPage  = "main.php";                // 돌아갈 페이지 (list.php)
    message("잘못된 접근입니다.", $goBackPage);
    ?>
<?php else: ?>
<body>
<script>
    // front 단에서 공란 검사, 버튼 클릭시 실행 되는 함수
    function login(){
        // loginForm 설정, JavaScript 에서 Submit 을 제어
        var loginForm     = document.loginForm;
        // 각 input 값 유효 확인을 위한 변수
        var userTitle     = loginForm.title.value;      // 글 제목
        var content       = loginForm.content.value;    // 글 내용

        if(!userTitle || !content){
            // 글 제목, 글 내용 작성 하지 않았을 경우
            alert("빈칸을 모두 입력해 주세요!");
            location.href='<?php echo "main.php"; ?>';
        }else{
            // 빈칸 없이 입력한 경우 submit 실행
            loginForm.submit();
        }
    }
</script>
<fieldset>
    <form name="loginForm" action="../controller/writeController.php" method="post">
        <legend>글쓰기</legend>
        <table>
            <tr><td>제목</td><td><input type="text" name="title"></td></tr>
            <tr><td>작성자</td><td><?php echo $_SESSION['id']; ?></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20'></textarea></td>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="password" value="<?php echo $_SESSION['password']; ?>">
                    <input type="hidden" name="loginType" value="admin">
                    <input type="button" onclick="login()" value="글쓰기" style="width: 100%">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
<?php endif; ?>
