<?php
$frontArr = $_POST['frontNm'];  // 입력 받은 앞 자리
$backArr  = $_POST['backNm'];   // 입력 받은 뒷 자리
$lastNum  = ($backArr % (pow(10, 1))) / pow(10, 0);
$MW       = (int)(($backArr % (pow(10, 7))) / pow(10, 6));

$checkArr_fr = [2,3,4,5,6,7];     // 체크수 앞 자리
$checkArr_ba = [8,9,2,3,4,5];     // 체크수 뒷 자리
$front_sum = 0;                   // 앞 자리 합계
$back_sum  = 0;                   // 뒷 자리 합계
$all_sum   = 0;                   // 앞 뒷 자리 합계

$age       = (int)(($frontArr % (pow(10, 6))) / pow(10, 5))
    .(int)(($frontArr % (pow(10, 5))) / pow(10, 4)); // 출생연도
$year      = "19".$age;      // 앞 자리의 연도 붙여줌

echo "dd".$year."<br>";
$ageDate   = date("Y");   // 현재 날짜
echo "현재 일시 : ".$ageDate."<br/>";
echo "나이 : ".($ageDate-$year)."(만 &nbsp".($ageDate-$year-1).")"."<br>";




if (!empty($frontArr) && !empty($backArr)){

    echo "앞자리 : <br>";
    for ($i = 6, $j = 0; $i > 0, $j<6; $i--, $j++){
        $frontArr_Num
            = ($frontArr % (pow(10, $i))) / pow(10, $i-1);
        echo ((int)$frontArr_Num)."&nbsp";
        $front_sum += ((int)$frontArr_Num*$checkArr_fr[$j]);
    }
    echo "<br> 앞자리 합 : ".$front_sum;


    echo "<br> 뒷자리 : <br>";
    for ($i = 7, $j = 0; $i > 0, $j<6; $i--, $j++){
        $backArr_Num
            = ($backArr % (pow(10, $i))) / pow(10, $i-1);
        echo ((int)$backArr_Num)."&nbsp";
        $back_sum += ((int)$backArr_Num*$checkArr_ba[$j]);
    }
    echo "<br> 뒷자리 합 : ".$back_sum;

    $all_sum = 11-(($front_sum+$back_sum)%11);
    echo "<br> 뒷자리 마지막 번호 :".$all_sum;
    echo "<br>".$lastNum;
    echo "<br>".$MW."<br>";



    if ($lastNum == $all_sum){
        switch ($MW) {
            case 1:
                echo "남성";
                break;
            case 2:
                echo "여성";
                break;
        }
        echo "<br>생년월일 : ";
        echo "<br>나이 : "."(만"."세)";

    } else {
        echo "잘못된 주민번호 입니다.";
    }
} else {
    echo "잘못된 접근";
}



