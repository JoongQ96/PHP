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
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

      
      
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
      
	<div id="main">

      
      <br/> 
      <div id="mapCanvas">
      <div id="map"></div>
      <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=22aac23323229215101cc14049fb025a"></script>
     
      
      </div>

      <div id="go_back">
         <button class="go_back_button" onclick="location.href='user_parking_pot.php'">뒤로가기</button>
      </div>
   </div>
</body>
</html>
<?
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

$connect = mysqli_connect("localhost", "root", "autoset", "valet") ;

$query ="select * from customer join area on customer.park_area = area.park_area"; 
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result)
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>마커 생성하기</title>
    
</head>
>
<body>
<div id="map" style="width:100%;height:350px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=22aac23323229215101cc14049fb025a"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(35.8964600, 128.6202708), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
// 마커가 표시될 위치입니다 
var markerPosition  = new kakao.maps.LatLng(<?echo $i?>, 128.6202708); 

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
    position: markerPosition
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

// 아래 코드는 지도 위의 마커를 제거하는 코드입니다
// marker.setMap(null);    
</script>
</body>
</html>