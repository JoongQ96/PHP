<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="data_process.php" method="post">
    <?php
    $num = $_POST['number']; // 입력 데이터 갯수
    ?>
    <fieldset style="width:300px">
        <legend>정수 <?$num?>개를 입력하시오</legend>
        <?php
        for ($i = 1; $i < ($num+1); $i++){
            ?>
            입력 값<?php echo $i; ?><input type="text" name="input<?php $i ?>"><br>
            <?php
        }
        ?>
        <input type="submit" value="입력하기">
    </fieldset>
</form>
</body>
</html>