<?php

session_start();
$connect = mysqli_connect('localhost', 'root', 'autoset', 'valet') or die("fail");

// 입력 받은 차량번호
$carnum_front = $_GET['carnum_front'];
if($carnum_front == '')
{   
    session_destroy();
    ?>
    <script>
        alert("차량 정보가 없습니다");
        location.replace("../index.php");
    </script>
    <?php
}

$query  = "select * from customer where carnum_front LIKE '%$carnum_front' and out_date = 0000-00-00";
$result = $connect->query($query);
$row = mysqli_fetch_assoc($result);
if($row >= 2 )
{   
    ?>        
        <script>
            location.replace("../index_Search.php?number=<?echo $carnum_front?>");
        </script>
    <?
}


// 차량 앞번호가 있는지 검사
$query  = "select * from customer where carnum_front='$carnum_front' and out_date = 0000-00-00";
$result = $connect->query($query);
$row = mysqli_fetch_assoc($result);
$row2 = mysqli_num_rows($result);

if($carnum_front == '관리자'){
    $_SESSION['carnum_front']   =  $carnum_front;
    ?>        
        <script>
            location.replace("admin_parking_pot.php");
        </script>
    <?php
}

// 차량 앞번호가 있다면 뒷번호 검사
if($row2 == 1) {
        // 뒷번호가 맞다면 세션 생성
    $_SESSION['carnum_front']   =  $carnum_front;
?>        
<script>
    alert("로그인 되었습니다.");
    location.replace("user_parking_pot.php");
</script>
<?php
}
else{
?>
<script>
    alert("차량 정보가 없습니다");
    location.replace("../index.php");
</script>
<?php
}
?>