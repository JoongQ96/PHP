<?php 
// 세션 공유하기 / 세션은 html태그 앞에 와야함

session_start(); 

if(!isset($_SESSION['carnum_front'])) {
?>
    <script>
        // 관리자가 아닐 경우 사용자 페이지로 이동
        alert("로그인을 해주세요");
        location.replace("../index.php");
    </script>
<?php
}

// 데이터베이스 연동
$connect = mysqli_connect("localhost", "root", "autoset", "valet") ;
// board를 검색하고 번호가 큰순서대로 정렬하기 구문을 변수로 지정
$query ="select * from customer";
// 검색 변수를 데이터베이스에 입력하고 변수로 저장 
$result = $connect->query($query);

    $carnum_front = $_SESSION['carnum_front'];     
    $query2 ="select * from customer where carnum_front  = '$carnum_front' and out_date = '0000-00-00 00:00:00'";

    $result2 = $connect->query($query2);
    $row2 = mysqli_fetch_assoc($result2);
    $area = $row2['park_area'].$row2['park_loc'];

?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>V.P.P</title>
      <script src="https://cdn.jsdelivr.net/npm/vue@2.5.2/dist/vue.js"></script>
      <script src="https://unpkg.com/vue-router@3.0.1/dist/vue-router.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
      <link href="../mobile.css" rel="stylesheet" type="text/css" media="all" />
      <link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
      <script src="../Home.js"></script>
      <script>
// ----------현재시간을 나타내는 함수----------------
function printTime() {
var clock = document.getElementById("clock");
var now = new Date();
var ampm;
if (now.getHours() >= 12) { 
    ampm = "PM";
} else { 
    ampm = "AM"; 
}
var nowTime = now.getFullYear() + "." + (now.getMonth()+1) + "." + now.getDate() + ". &nbsp;" + ampm + "&nbsp;" + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
clock.innerHTML = nowTime;
setTimeout("printTime()",1000);
}
window.onload = function() {
printTime();
}
// ----------------------------------------------

</script>
   </head>
<body>
<!-- 왼쪽 네비게이터 -->
<div id="page" class="container">
   <div id="header">
      <!-- 왼쪽 위 로고 -->
      <div id="logo">
         <img src="../images/fire.jpg" />&nbsp;&nbsp;&nbsp;
         <a href="../index.php">V.P.P</a>
      </div>
      <?php 
               $query      = "select * from customer where carnum_front='$carnum_front' and out_date = '0000-00-00 00:00:00'" ;
               $result     = $connect->query($query);
               $rows       = mysqli_fetch_assoc($result);
      ?>
   <div id="main">
      <div id="profile">
      <!-- Gps 버튼 -->
      <?
         $query ="select * from customer join area on customer.park_area = area.park_area WHERE carnum_front = '$carnum_front'"; 
         $result = $connect->query($query);
         $row = mysqli_fetch_assoc($result);
         $latitude = $row['latitude'];
         $longitude = $row['longitude'];
         
         ?>
      <div id="gps">
         <a class="gps_button" href = "https://map.kakao.com/link/to/<?echo $carnum_front?>,<?echo $latitude?>,<?echo $longitude?>">GPS</a>
      </div>
         <ul>
            <div id = "user_image">
               <img src="../images/user.jpg" />
            </div>
            <div class="car_num">
               <li>차량번호 : <?php echo $rows['carnum_front']?></li>
            </div>
            <div class="profile_content">
               <li id = "where_am_i">현재 위치 : 
                  <div class = "where_am_i">
                     <?php echo $rows['park_area'].$rows['park_loc']?>
                  </div>
               </li>
               <li><a href = "user_parking_pot_main.php" id="look_closer">자세히 보기</a></li>
               <li>입장 시간 : <?php echo $rows['in_date']?></li>
               <li>현재 시간 : <span class="date" id='clock'></span></li>
               <li>주차 시간 : 
                  <?php
                     // 입차시간~현재시간 비교
                     $now = date("Y-m-d H:i:s", time());
                     $in_Time           = new DateTime($rows['in_date'], new DateTimeZone('Asia/Seoul'));
                     $now_Time         = new DateTime($now, new DateTimeZone('Asia/Seoul'));   
                     $dateInterval     = $in_Time->diff($now_Time);
                     
                     echo $dateInterval->format('%D일 %H시간 %I분 %S초').'<br>';
                     
                     $date_cal = $dateInterval->format('%D일 %H시간 %I분 %S초');
                     mysqli_query($connect, "update customer set park_time='$date_cal' where carnum_front='$carnum_front'");
                  ?>
               </li>
               <li>주차 요금 :
                  <?php
                     $money = 0;
                     $default_time = $dateInterval->format('%Y-%M-%D %H:%I:%S');
                     
                     $default_time24 = '00-00-01 00:00:00';
                     $default_time12 = '00-00-00 12:00:00';
                     $default_time08 = '00-00-00 08:00:00';
                     $default_time03 = '00-00-00 03:00:00';
                     $default_time01 = '00-00-00 01:00:00';
                     
                     
                     if($default_time >= $default_time24){
                        $money = 20000;
                        echo $money."원";
                     }
                     else if($default_time >= $default_time12){
                        $money = 10000;
                        echo $money."원";
                     }else if($default_time >= $default_time08){
                        $money = 8000;
                        echo $money."원";
                     }else if($default_time >= $default_time03){
                        $money = 5000;
                        echo $money."원";
                     }
                     else if($default_time >= $default_time01){
                        $money = 2000;
                        echo $money."원";
                     }   
                     else
                        echo $money."원";
                     
                     mysqli_query($connect, "update customer set park_charge='$money' where carnum_front='$carnum_front'");
                        
                  ?>
                  <a id ="f5_icon" onClick="window.location.reload()" style="cursor: pointer;"><img src="../images/f5.png" width="20px" /></a>
               </li>
            </div>
         </ul>
         
         <div id="btn_logout_user">
            <button class="btn_logout" onclick="location.href='../logout.php'">로그아웃</button>
         </div>
         

      </div>
   </div>
   </div>
   <div id="app">
   </div>
</body>
</html>