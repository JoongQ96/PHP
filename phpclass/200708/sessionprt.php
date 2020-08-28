<?php
session_start();

// 현 세션에 저장된 세션 값 출력
echo $_SESSION['name']."<br>"; // Youngchul Jung
echo $_SESSION['age']."<br>";  // 22
echo $_SESSION['univ']."<br>"; // Yeungjin Univ

// 현 세션 ID 값 출력 : ~~~
echo session_id();