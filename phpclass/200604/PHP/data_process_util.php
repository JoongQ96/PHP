<?php 
function average($argList){

    $sum = sum($argList);
    $avg = $sum/count($argList);
    return $avg; 
}

function sum($argList){
    $sum = 0;
    foreach($argList as $arg){
        $sum += $arg;
    }
    return $sum;
}

function sort_bubble(&$argList, $arglsAscendingOrder){
    for($i = 0 ; $i < count($argList) ; $i++){
        for($j = 0 ; $j < $i ; $j++){
            if($arglsAscendingOrder){
                if($argList[$i] < $argList[$j]){
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }else{
                if($argList[$i] > $argList[$j]){
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }
        }
    }
    return $argList;
}

function median(&$argList){
    sort_bubble($argList,true);
    $med = 0;
    if(count($argList) % 2 == 0){
        $med = $argList[count($argList)/2] + $argList[count($argList)/2 -1];
    }else{
        $med = $argList[count($argList)/2];
    }
    return $med;
}

?>