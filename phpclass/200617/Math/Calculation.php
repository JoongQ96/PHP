<?php
require_once('db_conf.php');
$conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
$resultNum = $conn->query("select num from calculation");
$i = 0;
while($row = $resultNum->fetch_assoc()){
    $i = $row['num'];
}
$i = $i + 1;
if(isset($_POST['name']) && isset($_POST['korean']) && isset($_POST['english']) && isset($_POST['math'])){
    $sum = $_POST['korean'] + $_POST['english'] + $_POST['math'];
    $avg = round($sum/3, 1);
    $sql_insert = "insert into calculation(`num`, `name`, `korean`, `english`, `math`, `sum`, `avg`)
                     values('{$i}', '{$_POST['name']}','{$_POST['korean']}',
                     '{$_POST['english']}', '{$_POST['math']}', '$sum', '$avg' )";
    $conn->query($sql_insert);
} 

if(isset($_POST['numDelete'])){
    $numDelete = $_POST['numDelete'];
    $sql_delete = "DELETE FROM `calculation` WHERE `num` = $numDelete";
    $conn->query($sql_delete);
}
$result = $conn->query("select * from calculation");
if(isset($_POST['asc'])){
    $result = $conn->query("select * from calculation order by avg asc");
}else if(isset($_POST['desc'])){
    $result = $conn->query("select * from calculation order by avg desc");
}
?>
<body>
<tr>
    <td>번호</td><td>이름</td><td>국어</td>
    <td>영어</td><td>수학</td><td>합계</td>
    <td>평군</td><td></td>
</tr>
<?php
while($row = $result->fetch_assoc()){
    echo "<tr>";
    foreach($row as $value){
        echo "<td>" . $value . "</td>" ;
    }
    $i = $row['num'];
    echo '<td><button onclick="deletes(' . $i . ')">삭제</button></td>';
    echo "</tr>";
}
?>
</body>