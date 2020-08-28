<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once('data_process_util.php');
        $numOfData = $_POST['numOfData'];
        $valueArray = [];
        for($i = 0; $i < $numOfData ; $i++){
            $j = $i + 1;
            $valueArray[$i] = $_POST["value$j"];
        }

    ?>
    
    <table border=1>
        <tr>
            <td>입력 값</td>
            <td>
                <?php
                    for($i = 0; $i < $numOfData ; $i++){
                        $j = $i + 1;
                        $valueArray[$i] = $_POST["value$j"];
                        echo +$valueArray[$i]." ";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>총합 </td>
            <td><?=sum($valueArray)?></td>
        </tr>
        <tr>
            <td>평균</td>
            <td><?=average($valueArray)?></td>
        </tr>
        <tr>
            <td>중간</td>
            <td>
            <?=median($valueArray)?>
            </td>
        </tr>
        <tr>
            <td>소팅 후</td>
            <td>
                <?php 
                    sort_bubble($valueArray ,true);
                    foreach($valueArray as $value){
                        echo $value . " ";
                    }
                ?>
        </td>
        </tr>
        
        
    </table>
</body>
</html>