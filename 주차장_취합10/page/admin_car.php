<?php 
// 세션 공유하여 관리자로 접속한지 확인
session_start(); 

//관리자로 접속하지 않았을 경우 user_parking_pot로 보냄  
if($_SESSION['carnum_front'] != '관리자') 
{
    ?>
        <script>
            // 관리자가 아닐 경우 사용자 페이지로 이동
            alert("권한이 없습니다");
            location.replace("<?php echo 'user_parking_pot.php'?>");
        </script>
    <?php
}
// DB 연동             
$connect = mysqli_connect("localhost", "root", "autoset", "valet") ;
// 해당 주차위치를 GET으로 주차구역 받기
$place = $_GET['area']; 
// 해당 주차위치를 GET으로 주차번호 받기
$number = $_GET['number']; 
// 해당 주차구역과 주차번호를 합친 주차위치를 데이터베이스에서 검색
$query ="select * from customer where park_area  = '$place' and park_loc = $number";
$result = $connect->query($query);
// 데이터베이스에서 해당 주차위치가 검색된 열을 반환  
$row = mysqli_fetch_assoc($result);

// 데이터베이스에서 반환된게 없을 경우 메세지 출력 후 close
if($row == 0)
{
    ?>
    <script>
        alert("주차된 차량이 없습니다");
        close();
    </script>
    <?
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user_car</title>
    <link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body id = "join_car_body">
    <table class="join_car">
        <tr>
            <th scope="row">차량번호</th>
            <td>
                <?
                    // 데이터베이스에서 반환된 열의 차량번호 값을 출력 
                    echo $row['carnum_front']."<br>";
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">입장시간</th>
            <td>
                <?  
                    // DB에 저장된 입장시간 값 출력
                    echo $row['in_date'];
                ?>
            </td>
        </tr>

        <tr>
            <th scope="row">주차위치</th>
            <td>
                <?    
                    // 데이터베이스에서 반환된 열의 주차위치 값을 출력 
                    echo $row['park_area'].$row['park_loc']."<br>";
                ?>
            </td>
        </tr>

        <tr>
            <th scope="row">주차요금</th>
            <td>
                <?php
        
                    // 입차시간~현재시간 비교
                    // 현재시간을 연 월 일 시간 분 초
                    $now = date("Y-m-d H:i:s", time());
                    // 입장 시간(들어간 시간을 한국시간으로 객체화)
                    $in_Time           = new DateTime($row['in_date'], new DateTimeZone('Asia/Seoul'));
                    // 현재 시간(현재 시간을 한국시간으로 객체화)
                    $now_Time         = new DateTime($now, new DateTimeZone('Asia/Seoul'));   
                    // 주차시간 =  현재 시간 - 입장시간   
                    $dateInterval     = $in_Time->diff($now_Time);
                    // 주차시간을 데이터베이스에 문자열로 넣기 위해서 문자열 변수로 지정     
                    $date_cal = $dateInterval->format('%D일 %H시간 %I분 %S초');
                    // 주차요금을 데이터베이스에 업데이트
                    mysqli_query($connect, "update customer set park_time='$date_cal' where carnum_front='$carnum_front'");

                    // 주차요금 변수 초기화
                    $money = 0;
                    // 주차 시간을 연도 월 일 시간 분 초 
                    $default_time = $dateInterval->format('%Y-%M-%D %H:%I:%S');
                    
                    // 주차 시간 비교하여 주차요금 계산
                    $default_time24 = '00-00-01 00:00:00';
                    $default_time12 = '00-00-00 12:00:00';
                    $default_time08 = '00-00-00 08:00:00';
                    $default_time03 = '00-00-00 03:00:00';
                    $default_time01 = '00-00-00 01:00:00';
                    
                    // 주차 시간 비교 후 money에 요금을 시간마다 넣어주기
                    if($default_time >= $default_time24){
                        //1일
                        $money = 20000;
                        echo $money."원";
                    }
                    else if($default_time >= $default_time12){
                        //12시간
                        $money = 10000;
                        echo $money."원";
                    }else if($default_time >= $default_time08){
                        //8시간
                        $money = 8000;
                        echo $money."원";
                    }else if($default_time >= $default_time03){
                        //3시간
                        $money = 5000;
                        echo $money."원";
                    }
                    else if($default_time >= $default_time01){
                        //1시간
                        $money = 2000;
                        echo $money."원";
                    }   
                    else
                        // 기본값
                        echo $money."원";
                    // 주차요금을 데이터베이스에 주차요금 업데이트
                    $carnum_front = $row['carnum_front'];
                    mysqli_query($connect, "update customer set park_charge='$money' where carnum_front='$carnum_front'");
                ?>
            </td>
        </tr>
    </table>
</body>
</html>