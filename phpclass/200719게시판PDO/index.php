<?php
include ('controller/controller.php');

try {
    // 현 index.php
    $controller = new MyController(); // 컨트롤러 생성
    echo $controller->runController();

    // 현 요청이 무엇인지 파악 후, 해당 요청 모듈로 분기 또는 이동 <- MVC router, 라우팅 기능은 run()  안에 넣어야됨
    // 리스트
    // 글쓰기
    // 글보기
    // 글수정
    // 글삭제

} catch (Exception $e) {
    echo $e->getMessage();
    exit(-1);
}
?>
