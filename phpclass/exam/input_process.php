<?php
// 데이터 갯수 값 획득
$numOfData = $_POST['numOfData'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="data_process.php" method="post">
    <!-- 데이터 갯수 hidden value로 전달 -->
    <input type="hidden" name="numOfData" value="<?php echo $numOfData; ?>">
    <fieldset style="width:305px">
        <legend> 정수 <?php echo $numOfData; ?>개를 입력하시오</legend>
        <!-- 데이터 갯수 만큼, Input element 생성 -->
        <?php for($i =  0 ; $i < $numOfData ; $i++): ?>
            <!-- 입력 값 + 번호 -->
             <label for="gpa">입력 값  <?php echo ($i + 1); ?></label>
            <!-- Data 입력 용 Input Element naming : Ex) value1. value2 ...  -->
             <input type="text" id="gpa" name="<?php echo "value".($i+1); ?>" value="<?php echo $numOfData; ?>">
             <br>
        <?php endfor; ?>
        <input type="submit" value="입력하기">
    </fieldset>
</form>
</body>
</html>