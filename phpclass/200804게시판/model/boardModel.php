<?php
//
//// echo "debugging mode<br>";
//// echo "id - ".$id."<br>";
//// echo "pw - ".$pw."<br>";
//// echo "eeee - ".$checkUserCount."<br>";
//
//session_start();
//class db_info {
//    const db_url  = "localhost";
//    const user_id = "root";
//    const passwd  = "autoset";
//    const db      = "myboard";
//}
//
//// php DataBase Query 관련 클래스
//class board_Query {
//
//    public static $db_conn;
//
//    // -->> DataBase 연결 함수
//    public function __construct(){
//        // DataBase 연결
//        board_Query::$db_conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
//
//        // DataBase 연결 실패 message
//        if (board_Query::$db_conn->errno > 0) {
//            echo "DB 연결 실패";
//            exit(-1); // 시스템 종료
//        }
//        return board_Query::$db_conn;
//    }
//    // <<-- DataBase 연결 함수
//
//    // -->> 로그인 전용 함수
//    public function mySelect($tableName, $argValue1, $argValue2){
//        // select 위한 함수
//        $query = "select * from {$tableName} where user_id = '{$argValue1}' AND passwd = '{$argValue2}'";
//
//        return $result = board_Query::$db_conn->query($query);
//    }
//    // <<-- 로그인 전용 함수
//
////    public function querySelect($mode, $tableName, $arrayValue){
////        // select 위한 함수
////        $query = "select * from "."{$tableName}";
////        if ($mode == "login"){
////            $plusQuery = "where "."user_id = {$arrayValue["$id"]} AND passwd = {$arrayValue["$pw"]}";
////        }
////    }
//
//
//    public function queryInsert($mode, $tableName){
//        // insert 위한 함수
//
//        $db_conn = self::dbConnection();
//        if ($mode == "write") {
////             글 쓰기
////             board_id, board_pid, user_id, title, contents, hits, date, category
////             tableName -> board
//
//        } else {
////             덧글 작성
////             comment_id, board_id, contents, date
////             tableName -> comment
//        }
//        $query = "insert into "."$tableName";
//    }
//    // -->> write 쿼리, 글 등록 함수
//    function write($getUserInfo){
//        $db_conn = dbConnection();  // DataBase 연결 함수 호출
//        //             board_id, board_pid, user_id, title, contents, hits, date, category
//        $sql = "insert into board (user_id, title, contents, date)
//                           values ('{$getUserInfo["{$_SESSION['id']}"]}', '{$getUserInfo["{$_SESSION['password']}"]}', '{$getUserInfo['password']}',
//                                    '{$getUserInfo['title']}', '{$getUserInfo['content']}', now())";
//        $result = $db_conn->query($sql);
//
//        // DB로 쿼리 전송 실패인 경우 프로그램 종료
//        errorMsg($result);
//    }
//    // <<--
//
//
//
//
//
//    // -->> DB 쿼리 전송시 error 출력 메세지
//    public function errorMsg($result){
//        if (!$result){
//            echo "DB 데이터 전송 실패";
//            exit(-1);
//        }
//    }
//    // <<--
//}
//
//
//
