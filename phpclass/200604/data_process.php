<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input_process</title>
    <style>
        table, th, td {
            width: 800px;
            border: 1px black solid;
        }
    </style>
</head>
<body>
<?php
// data_process_util.php 의 메소드를 가져옴
require_once('data_process_util.php');
// input_process.php 에서 입력한 Data 갯수 받음
$count = $_GET['number'];
$array = [];
// input_process.php 에서 입력 받은 값들 배열에 저장
for($i = 0; $i < $count ; $i++){
    $array[$i] = $_GET["input".($i+1)];
}
?>
<table>
    <tbody>
    <tr>
        <th>입력 값</th>
        <td><?php foreach($array as $key) echo $key." " ?></td>
    </tr>
    <tr>
        <th>총합</th>
        <td><?php echo sum($array); ?></td>
    </tr>
    <tr>
        <th>평균</th>
        <td><?php echo average($array); ?></td>
    </tr>
    <tr>
        <th>중간 값</th>
        <td><?php echo median(sort_bubble($array, 'true')) ?></td>
    </tr>
    <tr>
        <th>소팅 후 (오름차순)</th>
        <td><?php foreach(sort_bubble($array, true) as $key) echo $key." " ?></td>
    </tr>
    <tr>
        <th>소팅 후 (내림차순)</th>
        <td><?php foreach(sort_bubble($array, false) as $key) echo $key." " ?></td>
    </tr>
    </tbody>
</table>
</body>
</html>
