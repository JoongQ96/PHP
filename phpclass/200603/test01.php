<?php
function setRandIntNum($argNumOfGRandNum,$argFrom,$argTo,$argAllowDuplicatedValue){
    $array = [];

    if ($argAllowDuplicatedValue){ // true
        // 중복값 허용 o
        for ($i=0; $i < $argNumOfGRandNum; $i++){
            $array[$i] = rand($argFrom, $argTo);
        }
    } else {                       // false
        // 중복값 허용 x
        for ($i=0; $i < $argNumOfGRandNum; $i++){
            $ranNum = rand($argFrom, $argTo); // 난수 생성

            for ($j = 0; $j < $i; $j++){
                if ($array[$j] == $ranNum && $i != $j){
                    $i--;
                    break;
                }
            }

            $array[$i] = $ranNum;
        }
    }
    return $array;
}

function sum($argList){
    $sum = 0;
    for ($i=0; $i < count($argList); $i++){
        $sum += $argList[$i];
    }
    return $sum;
}

function average($argList){
    return sum($argList)/count($argList);
}

//$myList  = setRandIntNum(7, 5, 10, true);

$myList  = setRandIntNum(4, 1, 10, false);
$sum     = sum($myList);
$average = average($myList);

echo "발생된 난수 값 : ";
foreach ($myList as $value)
    echo $value." ";
echo "<br>";
echo "난수 총 합 : $sum <br>";
echo "난수 평균  : $average <br>";





