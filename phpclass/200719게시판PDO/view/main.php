<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            margin: 0;
            padding:0;
        }
        .myTable {
            width: 95%;
            border: 10px solid #444444;
            border-collapse: collapse;
            margin: 5px;
            background-color: #00AAAA;
        }
        .container {
            width: 95%;
            display: flex;
            border: 1px solid black;
            margin: 5px;
        }
        #content1 {
            width: 20%;
            height: 100%;
            margin: 3px;
            border: 1px solid black;
        }
        #content2 {
            text-align: center;
            width: 80%;
        }
        .table {
            width: 100%;
            height: 70%;
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
        article{
            padding: 10px;
            margin: 3px;
            border: 1px solid black;
        }
    </style>
    <title>JoongKyu_Board</title>
</head>
<body>
<header>
    <table class="myTable">
        <tr><td><a href="<?php echo $_SERVER[PHP_SELF]; ?>"><h1>게시판</h1></a></td></tr>
    </table>
</header><hr>
<div class="container">
    <nav id="content1">
        <br><h3 style="text-align: center">메인메뉴</h3><br>
        <!------------------------------------------- 로그인 ------------------------------------------------------------------->
        <?php commonFunc::loginCheck(); // session_start, main.php 로그아웃 함수 ?>
        <fieldset style="width: 98%">
            <?php if (!isset($_SESSION['id'])): // login 안 한 경우 세션이 없는 경우 ?>
                <legend>로그인</legend>
                <form action="<?php echo BoardInfo::FILENAME_LOGIN; ?>" method="post">
                    <table>
                        <tr><td>아  이  디</td></tr>
                        <tr><td><input type="text" name="id"></td></tr>
                        <tr><td>비 밀 번 호</td></tr>
                        <tr><td><input type="password" name="password"></td></tr>
                        <tr><td><input style="width: 100%" type="submit" value="login"></td></tr>
                    </table>
                </form>
            <?php else: ?>
                <form action="<?php echo $_SERVER[PHP_SELF]; // login 한 경우 ?>" method="post">
                    <table>
                        <tr><td><?php echo "반갑습니다. <br>".$_SESSION['name']." 님"; ?></td></tr>
                        <tr><td><input style="width: 100%" type="submit" value="로그아웃" name="logout"></td></tr>
                    </table>
                </form>
            <?php endif; ?>
        </fieldset>
        <?php if(isset($_SESSION['id'])): // 로그인 한 경우에 버튼 출력 ?>
            <button style="width: 100%" onclick="location.href='<?php echo BoardInfo::FILENAME_WRITE; ?>'">글쓰기</button>
        <?php endif; ?>
    </nav>
    <article id="content2">
        <h2>Main Content</h2>
        <!------------------------------------------- 리스트 출력 ---------------------------------------------------------------->
        <form action="<?php echo BoardInfo::FILENAME_VIEW; ?>" method="get">
            <table class="table">
                <tr><th colspan="5">JoongKyu 게시판</th></tr>
                <tr style="border: #2b303b"><td>번호</td><td>제목</td><td>작성자</td><td>조회수</td><td>날짜</td></tr>
                <?php include('controller/mainPaging.php'); ?>
                <input type="hidden" name="thisPage" value="<?php echo $clickPageButton; ?>">
            </table>
        </form>
        <?php include('controller/mainButton.php') ;?><br><br>
        <!------------------------------------------ 검 색 ---------------------------------------------------------------------->
        <form action="<?php echo BoardInfo::FILENAME_MAIN; ?>" method="get">
            <select name="keyword">
                <option value='제목' name='title'>제목</option>
                <option value='내용' name='content'>내용</option>
                <option value='작성자' name='userName'>작성자</option>
                <option value='제목_내용' name='title_content'>제목+내용</option>
            </select>
            <input type="text" id="keyword_Text" name="searchText">
            <input type="submit" id="searchBtn" name="searchBtn" value="검색">
        </form>
        <br><br>
        <!---------------------------------------- 글쓰기 버튼 ------------------------------------------------------------------->
        <?php if ($searchKeyword != null): // 검색을 한 경우에 버튼 출력 ?>
            <button onclick="location.href='<?php echo BoardInfo::FILENAME_MAIN; ?>'">리스트</button>
        <?php endif; ?>
    </article>
</div>
</body>
</html>




