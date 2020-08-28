<?
require_once('write_process.php');
$userBoardId = $_GET['CheckBoardID']; // modify애서 hidden으로 받아온 게시판 id 값

$titleSql = "select * from mybulletin where board_id={$userBoardId}";
$selectResult = $db_conn->query($titleSql);
if ($selectResult->errno > 0) {
    echo "DB 연결 실패";
    exit(-1);
}
$totalRowNum  = $selectResult->fetch_array();

$boardID     = $totalRowNum['board_id'];      // 글 번호
$userTitle   = $totalRowNum['title'];         // 제목
$userName    = $totalRowNum['user_name'];     // 작성자
$userDate    = $totalRowNum['reg_date'];      // 작성시간
$userHit     = $totalRowNum['hits'];          // 조회수
$userContent = $totalRowNum['contents'];      // content
$userPasswd  = $totalRowNum['user_passwd'];   // 기존의 비밀번호


$modifyTitle        = $_GET['changeTitle'];    // 변경할 제목
$modifyName         = $_GET['changeName'];     // 변경할 이름
$modifyContent      = $_GET['changeContent'];        // 변경할 내용
$checkPasswd = $_GET['checkPasswd'];      // 입력한 비밀번호

// 유효성 검사
if (isset($_GET['changeTitle']) && isset($_GET['changeName']) && isset($_GET['checkPasswd']) && isset($_GET['changeContent'])){
    // 공란 검사
    if (($_GET['changeTitle'] == '') || ($_GET['changeName'] == '') || ($_GET['checkPasswd'] == '') || ($_GET['changeContent'] == '')) {
        // 수정할 글 제목, 작성자, 비밀번호, 글 내용 작성하지 않았을 경우
        echo "<script> alert('빈칸확인바람'); </script>";
        echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
    } else{
        // 글 제목, 작성자, 비밀번호, 글 내용 모두 작성한 경우
        $changeUserTitle    = htmlspecialchars("{$_GET['changeTitle']}", ENT_QUOTES);                                         // 글 제목, html tag 제거
        $changeUserName     = htmlspecialchars("{$_GET['changeName']}", ENT_QUOTES);                                          // 작성자, html tag 제거
        $changeContent      = htmlspecialchars("{$_GET['changeContent']}", ENT_QUOTES);                                       // 글 내용, html tag 제거
        if (password_verify($checkPasswd,$userPasswd)){
            // 사용자로부터 입력 받은 값 DB로 전송
            $changeSql ="update mybulletin set title='$changeUserTitle', user_name='$changeUserName',
                                           contents='$changeContent', reg_date=now() where board_id={$boardID}";
            $changeSqlResult = $db_conn->query($changeSql);

            // DB로 쿼리 전송 실패인 경우 프로그램 종료
            if (!$changeSqlResult){
                echo "DB에 데이터 수정 실패";
                exit(-1);
            }
            // 게시글 등록 완료된 경우
            echo "<script> alert('게시글이 성공적으로 수정되었습니다.')</script>";
            echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
        } else {
            echo "<script> alert('비밀번호확인바람'); </script>";
            echo "<script> location.href='list.php'; </script>"; // list.php 로 이동
        }
    }
}
?>






