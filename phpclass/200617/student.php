<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>성적 계산</title>
    <style>
        table,tr,td,th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<?php
require_once('db_util.php');

$db_conn = makeDBConnection();

if($mode == "insert") {
    $sql="";
    $sum = $_POST['kor']+$_POST['eng']+$_POST['math'];
    $avg = $sum/3;

    $sql = "insert into student (name, kor, eng, math, sum, avg) values";
    $sql = "($_POST[name],$_POST[kor],$_POST[eng],$_POST[math], $sum, $avg)";
} else if($mode == "delete") {
    
}

// // 이름, 국어, 영어, 수학, 총합, 평균
// $name  = $_GET['name'];
// $kor   = $_GET['kor'];
// $eng   = $_GET['eng'];
// $math  = $_GET['math'];
// $sum   = $kor + $eng + $math;
// $avg   = $sum / 3;
?>

<h2>성적처리 프로그램 예제</h2>
<p>학생 성적 입력하기</p>

<fieldset style="width: 80%">
    <table>
        <form action="<? echo $_SERVER[PHP_SELF] ?>" method='get'>
            <td bgcolor="white">
                이름 : <input type="text" size="8" name="name">
                국어 : <input type="text" size="8" name="kor">
                영어 : <input type="text" size="8" name="eng">
                수학 : <input type="text" size="8" name="math">
                <input type="submit" value="입력">
                <input type="hidden" name="mode" value="insert">
            </td>
        </form>

        <form action="<? echo $_SERVER[PHP_SELF] ?>" method='get'>
            <td bgcolor="white">
                <input type="submit" value="성적 정렬(오름차순)">
                <input type="hidden" name="mode" value="ascend">
            </td>
        </form>

        <form action="<? echo $_SERVER[PHP_SELF] ?>" method='get'>
            <td bgcolor="white">
                <input type="submit" value="성적 정렬(내림차순)">
                <input type="hidden" name="mode" value="descend">
            </td>
        </form>
    </table>
</fieldset>
<?php
$sql_search = 'select * from student';
$num = $_GET{num};

// button
if ($name != '' && $_GET['mode'] == "입력") {
    $sql_insert = "insert into student values(null,'$name','$kor','$eng','$math','$sum','$avg')";
} else if ($_GET['mode'] == "성적 정렬(오름차순)") {
    $sql_search = 'select * from student order by ascend desc';
} else if ($_GET['mode'] == "성적 정렬(내림차순)") {
    $sql_search = 'select * from student order by descend';
}

if ($show = $conn->query($sql_search)) {
    for ($i = 1; $row = $show->fetch_assoc(); $i++) {
        $num = $row[num];
        echo ("<tr>
                   <td>$i</td>
                   <td>$row[name]</td>
                   <td>$row[kor]</td>
                   <td>$row[eng]</td>
                   <td>$row[math]</td>
                   <td>$row[sum]</td>
                   <td>$row[avg]</td>
                   <td>
                        <form action='$_SERVER[PHP_SELF]' method='get'>
                        <input type='submit' value='삭제'>
                        <input type='hidden' name='mode' value=''>
                        </form>
                   </td>
               </tr>>");
    }
}



$conn->close();
?>




</body>
</html>