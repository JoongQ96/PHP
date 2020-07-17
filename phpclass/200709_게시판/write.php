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
<script>

    // 공란 검사, 버튼 클릭시 실행 되는 함수
    function login(){
        // loginForm 설정, JavaScript에서 Submit을 제어하기 위해
        var loginForm = document.loginForm;
        // 각 input 들의 값 확인을 위한 변수
        var userTitle     = loginForm.userTitle.value;
        var userName      = loginForm.userName.value;
        var userPassword  = loginForm.userPassword.value;
        var content       = loginForm.content.value;

        if(!userTitle || !userName || !userPassword || !content){
            // 글 제목, 작성자, 비밀번호, 글 내용 작성하지 않았을 경우
            alert("빈칸을 모두 입력해 주세요!");
            location.href='write.php';
        }else{
            // 빈칸 없이 입력한 경우 submit
            loginForm.submit();
        }
    }
</script>

<fieldset style="width: 50%">
    <legend>글쓰기</legend>
    <form name="loginForm" action="write_process.php" method="get">
        <table>
            <tr>
                <td>제목</td>
                <td><input type='text' size='50%' name='userTitle'></td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type='text' size='50%' name='userName'></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type='text' size='50%' name='userPassword'></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name='content' cols='80' rows='20'></textarea></td>
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











