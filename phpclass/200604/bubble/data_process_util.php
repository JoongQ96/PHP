<?php
// 버블 정렬
// argList : 배열
// $arglsAscendingOrder = True : 오름차순, False : 내림차순
function sort_bubble(&$argList, $arglsAscendingOrder) {
    // 오름차순
    if($arglsAscendingOrder) {
        for ($i = 0; $i < count($argList); $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($argList[$i] < $argList[$j]) {
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }
        }
    } else {
        // 내림차순
        for ($i = 0; $i < count($argList); $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($argList[$i] > $argList[$j]) {
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }
        }
    }
    return $argList;
}

// 입력 값의 합
function sum($argList) {
    $hap = 0;   // 합 구할 변수
    for($i = 0; $i < count($argList); $i++) {
        $hap += $argList[$i];
    }
    return $hap;
}

// 입력 값들의 평균
function average($argList) {
    return sum($argList)/count($argList);
}

function median($argList) {
    $mid = count($argList)/2;

    if (count($argList)% 2 == 0)
        return $argList[count($argList)/2 - 1];
    else
        return $argList[count($argList)/2];
}
?>