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
      <div id="parking_font">
               <span class = "font_blank2">A</span>
               <span class = "font_blank1">A</span>
               <span class = "font_blank2">B</span>
               <span class = "font_blank1">B</span>
            </div>
                  <div id="welcome">
                    <div class="title">
                     <!-- A구역에 table구성 -->
                     <div id = 'Atable'>
                  <table border = 1 class = "admin_parking_pot_table" >
                  <?
                     // num은 B구역에 주차된 차량 수를 저장
                     // place는 B구역에 있는지 판단하는 변수
                     $place = 'A';
                     // number로 B구역에 1~10 주차번호를 할당
                     for ($number = 1 ; $number <= 6 ; $number++) 
                     {
                        $num = 0;
                  ?>
                     <tr>
                        <!-- css에 있는 주차된 곳 class을 사용할지 if문을 사용  -->
                        <td class = 'null_a <?
                        $query ="select * from customer";
                        $result = $connect->query($query);
                        // 데이터베이스에 저장된 주차구역과 주차번호(for문으로 1씩 증가) 가져오기    
                        while($rows = mysqli_fetch_assoc($result))
                        {
                           // areas에 주차구역과 주차번호 가져오기 
                           $areas = $rows['park_area'].$rows['park_loc'];;
                           // 데이터베이스에 저장된 areas값과 테이블에 주차구역+주차번호가 일치할 경우    
                           if($number <= 6)
                              if($place.$number == $areas)
                              {
                              // 일치하면 차량이 있다는 것으로 css에서 class car를 사용
                                 if($place.$number == $area)
                                    echo 'parking';
                              // 차량이 있으면 num값을 더함(num값의 총 개수는 A구역의 총 주차 수)
                                 $num++;      
                                 break;
                              } 
                        }?>'>
                        <!-- 주차 번호를 클릭 했을 경우 admin_car.php를 작은창으로 띄우고(화면의 정가운데) get방식으로 값을 전달함(클릭된 주차구역+주차번호를 넘겨줌)  -->
                        <span>
                           <a class = "hyper_font">
                           <?
                           if($number <= 6)
                              echo $place.$number;
        
                              // 글자는 해당 주차구역과 주차번호를 나타냄
                           }?></a>
                        </span>
                        </td>
                     </tr>
                  </table>
               </div>
               

               <div class = 'road'>
                  <table>
                     <tr>        
                        <td class = 'road_td'></td>
                     </tr>
                  </table>
               </div>


               <div id = 'Atable'>
                  <table border = 1 class = "admin_parking_pot_table" >
                  <?
                     // num은 B구역에 주차된 차량 수를 저장
                     // place는 B구역에 있는지 판단하는 변수
                     $place = 'A';
                     // number로 B구역에 1~10 주차번호를 할당
                     for ($number = 12 ; $number > 6 ; $number--) 
                     {
                        $num = 0;
                  ?>
                     <tr>
                        <!-- css에 있는 주차된 곳 class을 사용할지 if문을 사용  -->
                        <td class = 'null_a <?
                        $query ="select * from customer";
                        $result = $connect->query($query);
                        // 데이터베이스에 저장된 주차구역과 주차번호(for문으로 1씩 증가) 가져오기    
                        while($rows = mysqli_fetch_assoc($result))
                        {
                           // areas에 주차구역과 주차번호 가져오기 
                           $areas = $rows['park_area'].$rows['park_loc'];;
                           // 데이터베이스에 저장된 areas값과 테이블에 주차구역+주차번호가 일치할 경우    
                           if($number > 6)
                              if($place.$number == $areas)
                              {
                              // 일치하면 차량이 있다는 것으로 css에서 class car를 사용
                                 if($place.$number == $area)
                                    echo 'parking';
                              // 차량이 있으면 num값을 더함(num값의 총 개수는 A구역의 총 주차 수)
                                 $num++;      
                                 break;
                              } 
                        }?>'>
                        <!-- 주차 번호를 클릭 했을 경우 admin_car.php를 작은창으로 띄우고(화면의 정가운데) get방식으로 값을 전달함(클릭된 주차구역+주차번호를 넘겨줌)  -->
                        <span>
                           <a class = "hyper_font">
                           <?
                           if($number > 6)
                              echo $place.$number;
        
                              //    글자는 해당 주차구역과 주차번호를 나타냄
                           }?></a>
                        </span>
                        </td>
                     </tr>
                  </table>
               </div>

               
               <div id = 'Btable'>
                  <table border = 1 class = "admin_parking_pot_table" >
                  <?
                     // num은 C구역에 주차된 차량 수를 저장
                     // place는 C구역에 있는지 판단하는 변수
                     $place = 'B';
                     // number로 C구역에 1~10 주차번호를 할당
                     for ($number = 1 ; $number <= 6 ; $number++) 
                     {
                        $num = 0;
                     ?>
                     <tr>
                        <!-- css에 있는 주차된 곳 class을 사용할지 if문을 사용  -->
                        <td class = 'null_b <?
                        $query ="select * from customer";
                        $result = $connect->query($query);
                        // 데이터베이스에 저장된 주차구역과 주차번호(for문으로 1씩 증가) 가져오기    
                        while($rows = mysqli_fetch_assoc($result))
                        {
                           // areas에 주차구역과 주차번호 가져오기 
                           $areas = $rows['park_area'].$rows['park_loc'];;
                              // 데이터베이스에 저장된 areas값과 테이블에 주차구역+주차번호가 일치할 경우    
                           if($number <= 6)
                              if($place.$number == $areas)
                              {
                              // 일치하면 차량이 있다는 것으로 css에서 class car를 사용
                                 if($place.$number == $area)
                                    echo 'parking';
                              // 차량이 있으면 num값을 더함(num값의 총 개수는 A구역의 총 주차 수)
                                 $num++;      
                                 break;
                              } 
                           
                        }?>'>
                        <!-- 주차 번호를 클릭 했을 경우 admin_car.php를 작은창으로 띄우고(화면의 정가운데) get방식으로 값을 전달함(클릭된 주차구역+주차번호를 넘겨줌)  -->
                        <span>
                           <a class = "hyper_font">
                           <!-- 글자는 해당 주차구역과 주차번호를 나타냄 -->
                           <?
                           if($number <= 6)
                              echo $place.$number;
        
                     }?></a>
                        </span>
                        </td>
                     </tr>
                  </table>
               </div>


               <div class = 'road'>
                  <table>
                     <tr>        
                        <td class = 'road_td'></td>
                     </tr>
                  </table>
               </div>
               <div id = 'Btable'>
                  <table border = 1 class = "admin_parking_pot_table" >
                  <?
                  // num은 C구역에 주차된 차량 수를 저장
                  // place는 C구역에 있는지 판단하는 변수
                  $place = 'B';
                  // number로 C구역에 1~10 주차번호를 할당
                  for ($number = 12 ; $number > 6 ; $number--) 
                  {
                     $num = 0;
                  ?>
                     <tr>
                        <!-- css에 있는 주차된 곳 class을 사용할지 if문을 사용  -->
                        <td class = 'null_b <?
                        $query ="select * from customer";
                        $result = $connect->query($query);
                        // 데이터베이스에 저장된 주차구역과 주차번호(for문으로 1씩 증가) 가져오기    
                        while($rows = mysqli_fetch_assoc($result))
                        {
                           // areas에 주차구역과 주차번호 가져오기 
                           $areas = $rows['park_area'].$rows['park_loc'];;
                           // 데이터베이스에 저장된 areas값과 테이블에 주차구역+주차번호가 일치할 경우    
                           if($number > 6)
                              if($place.$number == $areas)
                              {
                                 // 일치하면 차량이 있다는 것으로 css에서 class car를 사용
                                 echo 'car_b';
                                 // 차량이 있으면 num값을 더함(num값의 총 개수는 C구역의 총 주차 수)
                                 $num++;      
                                 break;
                              } 
                        }?>'>
                  <!-- 주차 번호를 클릭 했을 경우 admin_car.php를 작은창으로 띄우고(화면의 정가운데) get방식으로 값을 전달함(클릭된 주차구역+주차번호를 넘겨줌)  -->
                           <span>
                              <a class = "hyper_font">
                              <!-- 글자는 해당 주차구역과 주차번호를 나타냄 -->
                              <?
                              if($number > 6)
                                 echo $place.$number;
        
                     }?>
                           </a>
                           </span>
                        </td>
                     </tr>
                  </table>
               </div>
         <div id="go_back">
            <button class="go_back_button" onclick="location.href='user_parking_pot.php'">뒤로가기</button>
         </div>
	<div id="app">
	</div>
</body>
</html>
