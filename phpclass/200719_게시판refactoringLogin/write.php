<?php require_once ('db_conf.php'); session_start();?>
<?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
<?php
    $goBackPage  = BoardInfo::FILENAME_LIST;                // 돌아갈 페이지 (list.php)
    message("잘못된 접근입니다.", $goBackPage);
?>
<?php else: ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>
    // front 단에서 공란 검사, 버튼 클릭시 실행 되는 함수
    function login(){
        // loginForm 설정, JavaScript 에서 Submit 을 제어
        var loginForm     = document.loginForm;
        // 각 input 값 유효 확인을 위한 변수
        var userTitle     = loginForm.title.value;      // 글 제목
        var userName      = loginForm.name.value;       // 작성자 이름
        var userPassword  = loginForm.password.value;   // 작성자 비밀번호
        var content       = loginForm.content.value;    // 글 내용

        if(!userTitle || !userName || !userPassword || !content){
            // 글 제목, 작성자, 비밀번호, 글 내용 작성 하지 않았을 경우
            alert("빈칸을 모두 입력해 주세요!");
            location.href='<?php echo BoardInfo::FILENAME_WRITE; ?>';
        }else{
            // 빈칸 없이 입력한 경우 submit 실행
            loginForm.submit();
        }
    }
</script>
<fieldset style="width: 50%">
    <legend>글쓰기</legend>
    <form name="loginForm" action="<?php echo BoardInfo::FILENAME_WRITE_PROCESS; ?>" method="post">
        <table>
            <tr><td>제목</td><td><input type='text' size='50%' name='title'></td></tr>
            <tr>
                <td>작성자</td>
                <td>
                    <?php echo $_SESSION['id']; ?>
                    <input type="hidden" name="name" value="<?php echo $_SESSION['id']; ?>">
                </td>
            </tr>
            <tr><input type='hidden' size='50%' name='password' value="<?php echo $_SESSION['password']; ?>"></td></tr>
            <tr><td colspan="2"><textarea name='content' cols='80' rows='20'></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="loginType" value="admin">
                    <input type="button" onclick="login()" value="글쓰기" style="width: 100%">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>
<?php endif; ?>
