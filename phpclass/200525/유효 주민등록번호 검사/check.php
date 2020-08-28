<?php
$frontArr = $_POST['frontNm'];  // 입력 받은 앞 자리
$backArr  = $_POST['backNm'];   // 입력 받은 뒷 자리
$frontArr_Num[6] = [];
$backArr_Num[7]  = [];

$checkArr_fr = [2,3,4,5,6,7];     // 체크수 앞 자리
$checkArr_ba = [8,9,2,3,4,5];     // 체크수 뒷 자리
$front_sum = 0;                   // 앞 자리 합계
$back_sum  = 0;                   // 뒷 자리 합계
$all_sum   = 0;                   // 앞 뒷 자리 합계


if (!empty($frontArr) && !empty($backArr)){

    for ($i = 6, $j = 0; $i > 0, $j<6; $i--, $j++){
        $frontArr_Num[$i]
            = (int)(($frontArr % (pow(10, $i))) / pow(10, $i-1));
        $front_sum += ((int)$frontArr_Num[$i]*$checkArr_fr[$j]);    // 앞 자리 합
    }
    for ($i = 7, $j = 0; $i > 0, $j<6; $i--, $j++){
        $backArr_Num[$i]
            = (int)(($backArr % (pow(10, $i))) / pow(10, $i-1));
        $back_sum += ((int)$backArr_Num[$i]*$checkArr_ba[$j]);      // 뒷 자리 합
    }

    $year      = "19".$frontArr_Num[6].$frontArr_Num[5];      // 출생 연도
    $ageDate   = date("Y");                             // 현재 날짜
    $MW        = $backArr_Num[7];                             // 남녀 체크
    $lastNum   = (int)(($backArr % (pow(10, 1))) / pow(10, 0)); // 주민 번호 끝번호
    $all_sum   = 11-(($front_sum+$back_sum)%11);              // 체크 계산


    if ($lastNum == $all_sum){
        switch ($MW) {
            case 1:
                echo "남성";
                break;
            case 2:
                echo "여성";
                break;
        }
        echo "<br>생년월일 : 19".$frontArr_Num[6].$frontArr_Num[5]."년"
                               .$frontArr_Num[4].$frontArr_Num[3]."월"
                               .$frontArr_Num[2].$frontArr_Num[1]."일";
        echo "<br>나이 : ".($ageDate-$year+1)."(만 &nbsp".($ageDate-$year).")";

    } else {
        echo "잘못된 주민번호 입니다.";
    }
} else {
    echo "잘못된 접근";
}



