
<?php
if (!empty($_POST['value'])){
    $value = $_POST['value'];
    if ($_POST['value'] > 0 && $_POST['value'] < 10){
        for ($i = 1; $i < 10; $i++) {
            echo $value." X ".$i." = ".$value*$i."<br>";
        }
    }
    else{
        echo "1~9까지의 숫자만 입력하세요!!";
    }
} elseif (empty($_POST['value'])){
    echo "<table>";
    for ($j = 1; $j < 10; $j++) {
        //echo "<br>&nbsp";
        echo "<tr>";
        for ($i = 2; $i < 10; $i++) {
            echo "<td>".$i." X ".$j." = ".$j*$i."&nbsp"."&nbsp"."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

