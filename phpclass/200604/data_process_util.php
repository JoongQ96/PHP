<?php
// 총합
function sum($argList){
    $sum = 0;
    for ($i=0; $i < count($argList); $i++){
        $sum += $argList[$i];
    }
    return $sum;
}
// 평균
function average($argList){
    return round(sum($argList) / count($argList),2);
}
// 정렬
function sort_bubble(&$argList, $arglsAscendingOrder){
    if ($arglsAscendingOrder){ // true  : 오름차순
        for ($i = 0; $i < count($argList); $i++){
            for ($j = 0; $j < $i; $j++){
                if ($argList[$i] < $argList[$j]){
                    $change        = $argList[$i];
                    $argList[$i]   = $argList[$j];
                    $argList[$j] = $change;
                }

            }
        }
    } else{                    // false : 내림차순
        for ($i = 0; $i < count($argList); $i++){
            for ($j = 0; $j < $i; $j++){
                if ($argList[$i] > $argList[$j]){
                    $change        = $argList[$i];
                    $argList[$i]   = $argList[$j];
                    $argList[$j] = $change;
                }

            }
        }
    }
    return $argList;
}
// 중간값
function median($argList){
    if (count($argList)% 2 == 0){
        $med = ($argList[count($argList)/2 - 1] + $argList[count($argList)/2]) / 2;
    } else{
        $med = $argList[count($argList)/2];
    }
    return $med;
}
