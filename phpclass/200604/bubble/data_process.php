<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input_process</title>
    <style>
        table, th, td {
            width: 400px;
            border: 1px black solid;
            border-collapse: collapse;
        }
        .long {
            width: 800px;
        }
    </style>
</head>
<body>
<?php
    // data_process_util.php에서 메소드들 가져오기
    require_once('data_process_util.php');
    // input_process.php에서 전체 갯수 받아오기
    $count = $_GET['count'];
    // input_process.php에서 입력 받은 값들 배열에 저장
    for($i = 1; $i <= $count ; $i++){
        $array[$i-1] = $_GET["v$i"];
    }
?>
<table>
    <tbody>
        <tr>
            <th>입력 값</th>
            <td class="long"><?php foreach($array as $value) echo $value." " ?></td>
        </tr>
        <tr>
            <th>총합</th>
            <td class="long"><?php echo sum($array); ?></td>
        </tr>
        <tr>
            <th>평균</th>
            <td class="long"><?php echo average($array); ?></td>
        </tr>
        <tr>
            <th>중간 값</th>
            <td class="long"><?php echo median(sort_bubble($array, 'true')) ?></td>
        </tr>
        <tr>
            <th>소팅 후 (오름차순)</th>
            <td class="long"><?php foreach(sort_bubble($array, true) as $value) echo $value." " ?></td>
        </tr>
        <tr>
            <th>소팅 후 (내림차순)</th>
            <td class="long"><?php foreach(sort_bubble($array, false) as $value) echo $value." " ?></td>
        </tr>
    </tbody>
</table>
</body>
</html>