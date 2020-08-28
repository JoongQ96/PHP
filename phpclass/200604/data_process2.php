<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<?php
$num = $_GET['number']; // 입력 데이터 갯수
require_once('data_process_util.php');

$array = [];
for ($i = 0; $i < $num; $i++) {
    $array[$i] = $_GET['input'.($i+1)];
//    echo $array[$i]." ";
//    echo "zzzzzzzzzzzzz";
}
echo $_GET['number']."zzz".$num."<br>";
echo $_GET['input'.(0)];
echo $_GET['input'.(1)];
echo $_GET['input'.(2)];
echo $_GET['input'.(3)];
echo $_GET['input'.(4)];
echo $_GET['input'.(5)];



$list = $array;               // 정렬전
$sum = sum($array);           // 총합
$avg = average($array);       // 평균
sort_bubble($array, true);    // 정렬후
$med = median($array);        // 중간값
?>


<table style="width:800px">
    <tr>
        <th>입력 값</th>
        <td><?php
            echo $array[0];
            foreach ($list as $key)
                echo $key." ";
            ?>
        </td>
    </tr>
    <tr>
        <th>총합</th>
        <td><?php
            echo $sum;
            ?>
        </td>
    </tr>
    <tr>
        <th>평균</th>
        <td><?php
            echo round($avg, 2);
            ?>
        </td>
    </tr>
    <tr>
        <th>중간 값</th>
        <td><?php
            echo $med;
            ?>
        </td>
    </tr>
    <tr>
        <th>소팅 후</th>
        <td><?php
            foreach ($array as $key)
                echo $key;
            ?>
        </td>
    </tr>

</table>
</body>
</html>