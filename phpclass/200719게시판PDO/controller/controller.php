<?php
include('model/boardModel.php');    // model
include('library.php');             // 기본적인 기능들
include('board_conf.php');          // 게시판 환경설정 (페이지)
session_start();

class MyController
{

    public $myModel;

    // -->> 컨트롤러가 생성될 때 모델에 대한 객체 생성
    public function __construct()
    {
        $this->myModel = new board_Query();
    }
    // 컨트롤러가 생성될 때 모델에 대한 객체 생성 <<--

    // -->> 사용자 요청에 따른, 해당 모듈을 실행하고, 그 결과(뷰 파일)을 반환
    public function runController()
    {
        // 사용자가 특정 기능(게시판 : 예) 리스트, 글쓰기...)을 요청하면
        // 해당 요청의 모듈로 이동하라 -> route();
        return $routeResult = $this->route();
    }
    // 사용자 요청에 따른, 해당 모듈을 실행하고, 그 결과(뷰 파일)을 반환 <<--

    // -->> 로그인 기능
    public function login()
    {
        $id = $_POST['id'];       // 사용자로부터 입력 받은 ID 값
        $pw = $_POST['password']; // 사용자로부터 입력 받은 Password 값

        // DB 연결 설정
        $objDB = new board_Query();
        $userCheck = $objDB->mySelect($id, $pw);
        $userInfo = $userCheck->fetch_assoc();
        $checkUserCount = $userCheck->num_rows; // 정보가 일치하는 유저 정보 1명만 반환
        $goBackPage = BoardInfo::FILENAME_MAIN; // 돌아갈 페이지

        // ID, PW 체크
        if ($checkUserCount == 1) {
            // 로그인 성공 -> ID/PW 입력 값 일치할 경우
            // 세션들 변수 선언
            $_SESSION['name'] = $userInfo['user_name'];
            $_SESSION['id'] = $userInfo['user_id'];
            $_SESSION['password'] = $userInfo['passwd'];
            $_SESSION['grade'] = $userInfo['grade'];

            // main.php 로 복귀
            commonFunc::message($_SESSION['name'] . "회원님 환영합니다! ^^...", $goBackPage);
        } else {
            // 로그인 실패 -> ID/PW 입력 x , ID/PW 틀렸을 경우, main.php 로 복귀
            commonFunc::message("ID 또는 Password를 확인해 주세요.", $goBackPage);
        }
    }
    // 로그인 기능 <<--

    // -->> 글 쓰기 기능
    public function write()
    {

        // 글 쓰기 관련 컨트롤러 넣자!
        ob_start();
        include("view/write.php");
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
    public function write_process()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        $goBackPage = ""; // 페이지 이동 할 문자열
        $array = []; // 입력 데이터 처리 후 넣어 줄 배열
        $getUserInfo = []; // 유저로부터 입력받은 값을 넣어줄 배열
        $message = ""; // 메세지 입력 할 문자열

        if (isset($_POST['newBoard'])) {                            // 게시글 작성
            $getUserInfo = ['title', 'id', 'password', 'content'];     // 사용자에게 입력 받은 값들의 배열
            $goBackPage = BoardInfo::FILENAME_MAIN;                // 돌아갈 페이지
            $message = "게시글이 성공적으로 작성되었습니다.";

        } elseif (isset($_POST['newComment'])) {        // 덧글 작성
            $viewNowPage = $_POST['CheckNowPage']; // 게시글의 현재 블록의 페이지 번호
            $commentParentNum = $_POST['pid'];          // hidden 값 으로 받아온 게시글 번호
            $commentUser = $_POST['name'];         // 덧글 작성자 이름
            $commentContent = $_POST['content'];      // 덧글 내용
            $commentPw = $_POST['password'];     // 덧글 비밀번호

            $getUserInfo = ['pid', 'id', 'password', 'content'];                                               // 사용자에게 입력 받은 값들의 배열
            $goBackPage = BoardInfo::FILENAME_VIEW . "?board_id={$commentParentNum}&nowPage={$viewNowPage}"; // 돌아갈 페이지
            $message = "덧글이 성공적으로 작성되었습니다.";

        } else {                                    // error
            $goBackPage = BoardInfo::FILENAME_MAIN; // 돌아갈 페이지
            $message = "게시글 작성 실패 !!!";
        }
        // -->> 게시글, 덧글 작성 체크
        if (isset($_POST['newBoard']) || isset($_POST['newComment'])) {
            $array = commonFunc::contentCheck($getUserInfo, $goBackPage); // 유효성 검사, 공란 검사, html tag 제거, 비밀번호 암호화
            $obj = new board_Query();                                   // DB 연결 객체 생성
            $obj->write($array);                                          // 게시글 등록 쿼리 함수
        }
        return commonFunc::message($message, $goBackPage);                // 게시글 등록 완료된 경우 message 출력 후 페이지 이동
        // 게시글, 덧글 작성 체크 <<--
    }
    // 글 쓰기 기능 <<--

    // -->> 리스트 기능
    public function main()
    {

        // 리스트 관련 컨트롤러 넣자!
        // 지역변수 선언한 것이 include()에서 쓰임

        ob_start();                  // output buffer 시작한다 -> ob_end_clean() 만나기 전까지 출력하는 모든 구문들은 output buffer 저장된다.
        include("view/main.php");    // "view/main.php" -> 결과 값 저장(이 결과 값은 클라이언트 전송),
        // 위에서 ob_start()를 호출했기 떄문에 결과 값은 output buffer 저장된다. output buffer 저장이 되면서 PHP 코드는 번역 후 저장 된다.
        $result = ob_get_contents(); // output buffer 저장된 내용들을 문자열로 리턴한다.
        ob_end_clean();              // output buffer 출력을 종료한다.

        return $result;
    }
    // 리스트 기능 <<--

    // -->> 글 보기 기능
    public function view()
    {
        $pickTitleNum = $_GET['board_id'];  // list에서 받아온 게시판 글 번호
        $obj          = new board_Query();
        $boardValue   = $obj->selectBoardId($pickTitleNum); // 받아온 board_id 값으로 게시글 선택

        $obj->hitUp($pickTitleNum);

        $searchKeyword = $_GET['keyword'];    // 검색 option 선택 keyword
        $searchText    = $_GET['searchText']; // 검색 내용
        $searchBtn     = $_GET['searchBtn'];  // 검색 버튼 누른 것에 대한 값
        $nowPage       = $_GET['nowPage'];    // main.php 페이징 된 버튼을 클릭한 경우 페이지 번호

        ob_start();
        include("view/view.php");
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
    //  글 보기 기능 <<--

    // -->> 글 수정 기능
    public function modify()
    {
        if (isset($_SESSION['id'])) {                     // login 한 경우
            $boardID     = $_POST['boardID'];             // view에서 받아온 게시판 id 값
            $obj         = new board_Query();
            $boardValue  = $obj->selectBoardId($boardID);
            $checkPasswd = "";                            // 수정시 입력용 비밀번호
        }
        else {                                            // login 안 한 경우 세션이 없는 경우
            $goBackPage  = BoardInfo::FILENAME_MAIN;      // 돌아갈 페이지
            commonFunc::message("잘못된 접근입니다.", $goBackPage);
        }

        ob_start();
        include("view/modify.php");
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
    public function modify_process()
    {
        $userBoardId   = $_POST['CheckBoardID']; // modify애서 받아온 게시판 id 값
        ///////////////////////////////////////////////////////////////////////
        // 선택한 게시글 쿼리 함수
        $obj           = new board_Query();
        $totalRowNum   = $obj->selectBoardId($userBoardId);
        $userName      = $totalRowNum->user_name;   // 기존의 비밀번호

        ///////////////////////////////////////////////////////////////////////
        $modifyTitle   = $_POST['title'];          // 변경할 제목
        $modifyName    = $_POST['name'];           // 로그인 된 사용자 이름
        $modifyContent = $_POST['content'];        // 변경할 내용
        $thisUserName  = $_POST['thisUserName'];   // 글 작성자 이름

        ///////////////////////////////////////////////////////////////////////
        $getUserInfo = ['title','name','content'];                    // 사용자에게 입력 받은 값들의 배열
        $goBackPage  = BoardInfo::FILENAME_VIEW."?board_id={$userBoardId}";  // 돌아갈 페이지
        $array = [];                                                  // 입력 데이터 처리 후 넣어 줄 배열
        $array = commonFunc::contentCheck($getUserInfo, $goBackPage); // 유효성 검사, 공란 검사, html tag 제거

        if ($modifyName == $userName) {
            // 글 작성자와 로그인 된 사용자가 일치할 경우 글 수정 실행
            $obj->modify($array, $userBoardId);
            // 게시글 수정 완료된 경우 message 출력 후 list.php 로 이동
            commonFunc::message("게시글이 성공적으로 수정되었습니다.", $goBackPage);
        } else {
            commonFunc::message("사용자를 다시 확인해 주세요.", $goBackPage);
        }
    }
    // 글 수정 기능 <<--

    // -->> 글 삭제 기능
    public function delete()
    {
        if (isset($_SESSION['id'])) {                       // login 한 경우
            $boardID       = $_GET['board_id'];             // view에서 받아온 게시판 id 값
            $obj           = new board_Query();
            $boardValue    = $obj->selectBoardId($boardID);
        }
        else {                                              // login 안 한 경우 세션이 없는 경우
            $goBackPage  = BoardInfo::FILENAME_MAIN;        // 돌아갈 페이지
            commonFunc::message("잘못된 접근입니다.", $goBackPage);
        }

        ob_start();
        include("view/delete.php");
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
    public function delete_process()
    {
        $boardID       = $_POST['boardID'];
        $commentID     = $_POST['commentUserID'];
        $obj           = new board_Query();
        // 선택한 게시글 쿼리 함수
        $totalRowNum   = $obj->selectBoardId($boardID); // 쿼리 연산
        $userPasswd    = $totalRowNum->user_passwd;     // 기존의 비밀번호
        $boardUserName = $totalRowNum->user_name;       //
        $goBackPage    = BoardInfo::FILENAME_MAIN;      // 돌아갈 페이지 (view.php)
        $array = [];                                    // 입력 데이터 처리 후 넣어 줄 배열

        if (isset($_POST['delComment'])) {
            $nowPage     = $_POST['nowPage'];
            $obj->delete($commentID);
            // 비밀번호 일치, 덧글 삭제 완료된 경우, view.php 로 이동
            commonFunc::message("덧글이 성공적으로 삭제되었습니다.", $goBackPage);

        } else {
            $checkPasswd   = $_POST['checkPasswd'];      // 사용자에게 입력 받은 비밀번호
            $nowUserID     = $_POST['userID'];           // 현재 로그인된 사용자
            $getUserInfo   = $_POST['checkPasswd'];      // 사용자에게 입력 받은 값들의 배열
            $array         = commonFunc::contentCheck($checkPasswd, $goBackPage);   // 유효성 검사, 공란 검사, html tag 제거

            // 비밀번호 일치 여부 확인
            if (password_verify($checkPasswd,$userPasswd)){ // 패스워드 확인
                // 글 작성자 일치 여부 확인
                if ($nowUserID == $boardUserName){
                    // 게시글 삭제
                    $obj->delete($boardID);
                    // 비밀번호 일치, 게시글 삭제 완료된 경우, list.php 로 이동
                    commonFunc::message("게시글이 성공적으로 삭제되었습니다.", $goBackPage);
                }
            } else {
                // 비밀번호 불일치, list.php 로 이동
                commonFunc::message("비밀번호를 확인해 주세요.", $goBackPage);
            }
        }
    }
    // 글 삭제 기능 <<--

    // -->> 라우팅 기능
    public function route()
    {
        // 사용자가 요청한 모듈...을 어떻게 구분 할건데?
        // 사용자가 글쓰기를 요청하는? 또는 글 보기를 요청하는지?.. route()에서 어떻게 구분해서 판단 할 것인가?

        // URL Path 정보를 이용해서 실행할 수 있음
        // 일반적인 URL Path 정보는 http//localhost/index.php
        // 변경할 URL Path 정보는 http//localhost/index.php/list -> 글 리스트
        // 변경할 URL Path 정보는 http//localhost/index.php/write -> 글 쓰기
        // 변경할 URL Path 정보는 http//localhost/index.php/view -> 글 보기

        $pathInfo = explode("/", ltrim($_SERVER['REQUEST_URI'], "/"));
        $pickPage = 0;

        if ($pathInfo[3] == "board") {
            switch ($pathInfo[4]) {
                case 'login':
                    $pickPage = $this->login();
                    break;
                case strpos($pathInfo[4],"main"):
                    $pickPage = $this->main();
                    break;
                case "write":
                    $pickPage = $this->write();
                    break;
                case "write_process":
                    $pickPage = $this->write_process();
                    break;
                case strpos($pathInfo[4],"view"):
                    $pickPage = $this->view();
                    break;
                case strpos($pathInfo[4],"modify"): // 문자열에 modify 포함한 경우 true
                    $pickPage = $this->modify();
                    break;
                case strpos($pathInfo[4],"mod_process"):
                    $pickPage = $this->modify_process();
                    break;
                case strpos($pathInfo[4],"delete"):
                    $pickPage = $this->delete();
                    break;
                case strpos($pathInfo[4],"del_process"):
                    $pickPage = $this->delete_process();
                    break;
                default:
                    $pickPage = "default 페이지이지만 현재 오류가 있습니다.";
            }
        }
        return $pickPage;
    }
    // 라우팅 기능 <<--
}