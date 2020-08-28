<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .myTable {
            width: 100%;
            border: 10px solid #444444;
            border-collapse: collapse;
            padding: 10px;
        }
        nav {

            width: 15%;

            height: 600px;

            border: 1px solid black;

        }
    </style>
    <title>Document</title>
</head>
<body>

<header>
    <table class="myTable">
        <tr>
            <td><a href="<?php $_SESSION=array(); echo $_SERVER[PHP_SELF];?>"><img src="home.png" alt="홈으로"></a></td>
            <td><a href="<?php echo $_SERVER[PHP_SELF]; ?>"><h1>게시판</h1></a></td>
        </tr>
    </table>
</header>
<hr>
<div id="main">
    <nav>
        <h3>메인메뉴</h3>
        <!------------------------------------------- 로그인 ------------------------------------------------------------------->
        <?php
        session_start();
        if (isset($_POST['logout'])) {
            // 새로고침 할 경우 세션이 종료를 방지
            // logout 세션이 있는 경우
            $_SESSION = array();
            session_destroy();
        }
        ?>
        <fieldset style="width: fit-content">
            <?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
                <legend>로그인</legend>
                <form action="../controller/loginController.php" method="post">
                    <table>
                        <tr><td>아  이  디</td><td><input type="text" name="id"></td></tr>
                        <tr>
                            <td>비 밀 번 호</td>
                            <td><input type="password" name="password"></td>
                            <td><input type="submit" value="login"></td>
                        </tr>
                    </table>
                </form>
            <?php else: ?>
                <form action="<?php echo $_SERVER[PHP_SELF]; // login 한 경우 ?>" method="post">
                    <table>
                        <tr><td><?php echo "이 름 : ".$_SESSION['name']; ?></td></tr>
                        <tr><td><input type="submit" value="로그아웃" name="logout"></td></tr>
                    </table>
                </form>
            <?php endif; ?>
        </fieldset>

        <?php
        echo "SESSION['id'] : ".$_SESSION['id']."<br>";
        echo "이 름 : ".$_SESSION['name']."<br>";
        ?>

        <?php if(isset($_SESSION['id'])): // 로그인 한 경우에 버튼 출력 ?>
        <button onclick="location.href='write.php'">글쓰기</button>
        <?php endif; ?>
    </nav>

    <article>
        <h2>Main Content</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates harum accusantium debitis perferendis sequi beatae odit nam eveniet, amet iusto sapiente magni ut molestias, animi explicabo esse ?
        </p>


    </article>
    <aside>
        <h3>aside</h3>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, cumque.
    </aside>

</div>
<footer>
    <h3>footer</h3>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea placeat commodi hic!
</footer>

</body>
</html>




