<?php
    // 세션을 가져와 공유하기
    session_start();
    // 세션 박살내기
    session_destroy();
?>
<!-- 자동으로 login.php 파일로 보내기/ 숫자 0은 몇초뒤에 보낼지 -->
<meta http-equiv="refresh" content="0;url=index.php" />