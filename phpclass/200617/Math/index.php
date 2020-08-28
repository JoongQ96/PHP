<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//code.jquery.com/jquery.min.js"></script>
</head>
<?php 
    require_once('db_conf.php');
    $conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
    $result = $conn->query("select * from calculation");
?>
<body>
    <fieldset style ="with:300px">
        <legend>학생성적 입력하기</legend>
        이름   <input id = "name"   type="text" name="name">
        국어 : <input id = "korean" type="text" name="korean">
        영어 : <input id = "english" type="text" name="english">
        수학 : <input id = "math" type="text" name="math">
        <button onclick="input()">입력</button>
        <button onclick="asc()">오름차순</button>
        <button onclick="desc()">내림차순</button>
    </fieldset>
    <table id="names" border="1">
        <tr>
            <td>번호</td><td>이름</td><td>국어</td>
            <td>영어</td><td>수학</td><td>합계</td>
            <td>평군</td><td></td>
        </tr>
        <?php
            $i = 0;
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
    </table>
    <script>
        var i = 1;
        function input(){
            var name = $("#name").val();
            var korean = $("#korean").val();
            var english = $("#english").val();
            var math = $("#math").val();
            if(name == "" || korean == "" || english == "" || math == ""){
                return alert("다시입력해주세요.");
            }
            $.ajax({
                url: "Calculation.php",
                type: "post",
                data: {i:i + <?= $i?>, name:name, korean:korean, english:english,math:math},
            }).done(function(data) {
                $('#names').html(data);
            });
        }
        function asc(){
            var asc = true;
            $.ajax({
                url: "Calculation.php",
                type: "post",
                data: {asc:asc},
            }).done(function(data) {
                $('#names').html(data);
            });
        }
        function desc(){
            var desc = true;
            $.ajax({
                url: "Calculation.php",
                type: "post",
                data: {desc:desc},
            }).done(function(data) {
                $('#names').html(data);
            });
        }
        function deletes(numDelete) {
            $.ajax({
                url: "Calculation.php",
                type: "post",
                data: {numDelete:numDelete},
            }).done(function(data) {
                $('#names').html(data);
            });
        }
    </script> 
</body>
</html>
