
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
$carnum_front = $_SESSION['carnum_front'];
$connect = mysqli_connect("localhost", "root", "autoset", "valet") ;

$query ="select * from customer join area on customer.park_area = area.park_area WHERE carnum_front = '$carnum_front'"; 
$result = $connect->query($query);
$row = mysqli_fetch_assoc($result);
$latitude = $row['latitude'];
$longitude = $row['longitude']; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>마커 생성하기</title>
</head>

<body>
<div id="map" style="width:100%;height:350px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=22aac23323229215101cc14049fb025a"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(<?echo $latitude?>, <?echo $longitude?>), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

// 마커를 생성합니다
var positions = [
    {
        title: '<?echo $carnum_front?>', 
        latlng: new kakao.maps.LatLng(<?echo $latitude?>, <?echo $longitude?>) 
    },
    { 
        latlng: new kakao.maps.LatLng(35.8964300, 128.6202708)
    },
];
// 마커가 지도 위에 표시되도록 설정합니다
// marker.setMap(map);

var imageSrc = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 
    
for (var i = 0; i < positions.length; i ++) {
    
    // 마커 이미지의 이미지 크기 입니다
    var imageSize = new kakao.maps.Size(24, 35); 
    
    // 마커 이미지를 생성합니다    
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
    
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[i].latlng, // 마커를 표시할 위치
        title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
        image : markerImage // 마커 이미지 
    });
} 
</script>


</body>
</html>
