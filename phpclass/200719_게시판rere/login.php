<?php
// 로그인 페이지
require_once('db_conf.php');
?>
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
<?php
session_start();
if (isset($_POST['logout'])) { // -> isset : 선언o, null값 x인경우 true
    // 새로고침 할 경우 세션이 종료를 방지
    // logout 세션이 있는 경우
    $_SESSION = array();
    session_destroy();
}
if (!isset($_SESSION['login'])){ // login 세션이 없는 경우
    ?>
    <fieldset style="width: 30%">
        <form action="result.php" method="get">
            <table>
                <tr>
                    <th>
                        I D :
                    </th>
                    <td>
                        <input type="text" name="id">
                    </td>
                </tr>
                <tr>
                    <th>
                        암호 :
                    </th>
                    <td>
                        <input type="text" name="password">
                        <input type="submit" value="로그인">&nbsp
                    </td>
                </tr>
            </table>
        </form>
        <a href='newAccount.php'>회원가입</a>
    </fieldset>
    <?php
}
// 로그인 성공, 회원 정보 보기 클릭 시 출력
else {
    echo $_SESSION['name']."님이 로그인 하셨습니다.<br>";
    echo "나이 : ".$_SESSION['age']."<br>";
    echo "회원등급 : ".$_SESSION['grade']."<br>";
    ?>
    <form action="<?php $_SERVER[PHP_SELF] ?>" method="post">
        <input type="submit" value="로그아웃" name="logout">
    </form>
    <?php
}
?>
</body>
</html>

