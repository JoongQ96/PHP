<?php
// -->> 모든 페이지에서 공통적으로 사용되는 클래스
class commonFunc {
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // -->> session_start, main.php 로그아웃 함수
    public static function loginCheck(){
        session_start();
        if (isset($_POST['logout'])) {
            // 새로고침 할 경우 세션이 종료를 방지
            // logout 세션이 있는 경우
            $_SESSION = array();
            session_destroy();
        }
    }
    // session_start, main.php 로그아웃 함수 <<--

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // -->> 로그인 체크 함수
    public static function sessionCheck($goBackPage) {
        if (!isset($_SESSION['id'])) {                       // login 안 한 경우 세션이 없는 경우
            commonFunc::message("잘못된 접근입니다.", $goBackPage);
        }
    }
    // 로그인 체크 함수 <<--

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //  -->> 공란 체크 함수
    public static function contentCheck($getUserInfo, $goBackPage) {
        $array = [];    // 입력 받은 값들을 담을 배열

        // 유효성 검사 & 공란 확인
        foreach ($getUserInfo as $key => $value) {
            if (isset($_POST[$value])){      // 유효성 확인
                if ($_POST[$value] == ''){   // 공란 확인
                    // 공란이 있는 경우
                    commonFunc::message("빈칸을 확인해 주세요.", $goBackPage);
                } else{
                    // 공란 없이 전부 입력한 경우
                    if ($value == "password") {
                        // 입력 값이 password 경우
                        $array[$value] = password_hash(htmlspecialchars($_POST[$value], ENT_QUOTES), PASSWORD_DEFAULT);
                    } else {
                        // 그 외의 입력 값의 경우
                        $array[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
                    }
                }
            }
        }
        return $array;  // 배열 반환
    }
    // 공란 체크 함수 <<--

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // -->> alert message 출력 함수
    public static function message($getMessage, $goBackPage){

        $printMessage = "<script> alert('$getMessage');";
        echo $printMessage."location.href = '$goBackPage'; </script>";
        exit(-1);
    }
    // alert message 출력 함수 <<--
}
// 모든 페이지에서 공통적으로 사용되는 함수들 <<--
