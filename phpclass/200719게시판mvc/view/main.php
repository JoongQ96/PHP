<?php require_once('../model/boardModel.php'); require_once('../controller/library.php'); ?>
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

         .table {
             border-collapse: collapse;
             border-top: 3px solid #168;
         }
        .table th {
            color: #168;
            background: #f0f6f9;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
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
//        error_reporting(E_ALL);
//        ini_set("display_errors", 1);

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
        <?
        echo "id : ".$_SESSION['id']."<br>";
        echo "name : ".$_SESSION['name']."<br>";
        ?>
        <!------------------------------------------- 글쓰기 ------------------------------------------------------------------->
        <?php if(isset($_SESSION['id'])): // 로그인 한 경우에 버튼 출력 ?>
            <button onclick="location.href='write.php'">글쓰기</button>
        <?php endif; ?>

    </nav>

    <article>
        <h2>Main Content</h2>
        <!------------------------------------------- 게시판 ------------------------------------------------------------------->
        <form action="../controller/viewProcess.php" method="get">
            <table class="table">
                <tr><th colspan="5">JoongKyu 게시판</th></tr>
                <tr style="border: #2b303b"><td>번호</td><td>제목</td><td>작성자</td><td>조회수</td><td>날짜</td></tr>
                <?php

                // 리스트 출력 연산을 위한 함수
                $obj = new board_Query();

                // $pagingSql     = "select * from board where board_pid = 0";
                $clickPageButton = isset($_GET['nowPage'])? $_GET['nowPage']: 1;      // 클릭한 버튼의 입력값 받아옴
                $pagingSql     = $obj->querySelect("paging","board", 0, 0);

                $pagingResult  = board_Query::$db_conn->query($pagingSql);
                $totalRowNum   = $pagingResult->num_rows;                                // 덧글 제외한 게시글 전체 row 갯수
                $showTextNum   = 5;                                                      // 한 페이지 당 출력할 게시글 수
                $totalPageNum  = ceil($totalRowNum/$showTextNum);                   // 전체 페이지 수
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $showButtonNum = 10;                                                     // 블럭당 출력할 버튼 수
                $nowBlockNum   = ceil($clickPageButton/$showButtonNum);             // 현재 블록 number
                $startPageNum  = ($nowBlockNum * $showButtonNum) - ($showButtonNum - 1); // 보여줄 블록의 첫번째 버튼
                $endPageNum    = $nowBlockNum * $showButtonNum;                          // 보여줄 블록의 마지막 버튼
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $searchKeyword = $_GET['keyword'];     // 검색 시 option 선택 keyword
                $searchText    = $_GET['searchText'];  // 검색 내용

                // 리스트 출력 함수, $changeSql 반환
                $changeSql = $obj->listQuery($clickPageButton, $showTextNum, $searchKeyword, $searchText);

                ?>
                <input type="hidden" name="board_id" value="">
                <input type="hidden" name="thisPage" value="<?php echo $clickPageButton; ?>">
            </table>
        </form>
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




