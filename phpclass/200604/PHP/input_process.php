<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $numOfData = $_POST['numOfData'];
    ?>
    <form action="data_process.php" method="post">
        <fieldset style ="with:300px">
        <legend>정수 <?=$numOfData?>개를 입력하시오</legend>
        <input type="hidden" name="numOfData" value="<?=$numOfData?>">
        <?php for($i = 1; $i <= $numOfData ; $i++){?>
        입력 값 <?=$i?> <input type="text" name="value<?=$i?>"><br>
        <?php }?>
            <input type="submit" value="입력하기">
        </fieldset>
    </form>
</body>
</html>