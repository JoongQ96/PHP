<?php
require_once ('data_process_util.php');

// 입력 데이터 갯수 획득, hidden value
$numOfData = $_POST['numOfData'];

//  입력 데이터 값 저장 List
$myList = [];

// 입력 값 List 내  저장
for($i = 0 ; $i < $numOfData ; $i++)
    $myList[] =  (integer)$_POST["value".($i+1)];

// 소팅 전 값을 출력하기 위해 Array 복사
$myListPrev = $myList;

//  배열 내 원소 합
$sum = sum($myList);

// 배열 내 원소 평균 값
$average = average($myList);

// 오름차순 버블 소팅
sort_bubble($myList, true);

// 중간 값 계산
$median = median($myList);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
    </style>
</head>
<body>
<table style="width:500px">
    <tr>
        <th>입력 값</th>
        <!-- 입력 데이터 (정렬 전) 출력 -->
        <td> <?php foreach($myListPrev as $value) echo $value." "; ?> </td>
    </tr>
    <tr>
        <th>총합</th>
        <td> <?php echo $sum; ?></td>
    </tr>
    <tr>
        <th>평균</th>
        <td> <?php echo round($average, 2); ?></td>
    </tr>
    <tr>
        <th>중간 값</th>
        <td> <?php echo $median; ?></td>
    </tr>
    <tr>
        <th>소팅 후</th>
        <!-- 입력 데이터 (정렬 후) 출력 -->
        <td> <?php foreach($myList as $value) echo $value." "; ?> </td>
    </tr>

</table>
</body>
</html>
