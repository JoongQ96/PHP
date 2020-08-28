<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input_process</title>
</head>
<body>
<?php
// input에서 갯수 받아오기
$count = $_GET['count'];
?>
<form action="data_process.php" method="get">
    <fieldset style ="width:300px">
        <legend>정수 <?php echo $count?>개를 입력하시오</legend>
        <input type="hidden" name="count" value="<?php echo $count?>">
        <?php for($i = 1; $i <= $count ; $i++): ?>
            입력 값 <?php echo $i?> <input type="text" name = "v<?php echo $i?>" style="width: 140px"><br>
        <?php endfor; ?>
        <input type="submit" value="입력하기">
    </fieldset>
</form>
</body>
</html>