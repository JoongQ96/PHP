<?php
// sum($argList)
// 배열 내 원소 값에 대한 합 반환
// <<-- Parameter
// $argList : 배열 값
// -->> End Parameter
// return : 배열 원소의 총 합
function sum($argList){
    $result = 0;
    foreach ($argList as $value)
        $result += $value;
    return $result;
}

// average($argList)
// 배열 내 원소 값에 대한 평균 반환
// <<-- Parameter
// $argList : 배열 값
// -->> End Parameter
// return : 배열 원소의 평균 값
function average($argList){
    return sum($argList)/count($argList);
}

// sort_bubble($argList, $argIsAscendingOrder)
// 입력 배열을 버블소팅을 이용하여 오름차순 또는 내림차순 정렬 후 반환
// <<-- Parameter
// $argList : 배열 값
// $argIsAscendingOrder : true 오름차순, false : 내림차순
// -->> End Parameter
// return : 정렬된 배열
function sort_bubble(&$argList, $argIsAscendingOrder)
{
    $sizeOfList = count($argList);
    for($i = $sizeOfList - 1 ; $i > 0 ; $i--) {
        for($j = 0 ; $j < $i ; $j++) {
            if($argList[$j] > $argList[$j + 1]) {
                $temp = $argList[$j];
                $argList[$j] = $argList[$j + 1];
                $argList[$j + 1] = $temp;
            }
        }
    }
}

// median($argList)
// 입력 배열을 중간 값 반환
// <<-- Parameter
// $argList : 배열 값
// -->> End Parameter
// return : 중간 값
function median($argList)
{
    $sizeOfList = count($argList);

    sort_bubble($argList, true);

    if($sizeOfList % 2 == 0)
        return ($argList[$sizeOfList/2 - 1] + $argList[$sizeOfList/2])/2;
    else
        return $argList[$sizeOfList/2];
}