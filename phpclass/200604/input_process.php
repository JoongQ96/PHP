<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$num = $_GET['number']; // 입력 데이터 갯수
?>
<form action="data_process.php" method="get">
    <fieldset style="width:300px">
        <legend>정수 <? echo $num;?>개를 입력하시오</legend>
        <input type="hidden" name="number" value="<?php echo $num; ?>">
        <?php for ($i = 1; $i < ($num+1); $i++): ?>
        입력 값<? echo $i."&nbsp"; ?><input type="text" name="input<?php echo $i; ?>"><br>
        <?php endfor; ?>
        <input type="submit" value="입력하기">
    </fieldset>
</form>
</body>
</html>

