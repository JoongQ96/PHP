<?
// 관리자 페이지
session_start(); 
// 로그인이 되지 않았을 경우 메인페이지로 이동
if(!isset($_SESSION['carnum_front']))
{
  ?>
      <script>
      // 관리자가 아닐 경우 사용자 페이지로 이동
          alert("로그인을 해주세요");
          location.replace("../index.php");
      </script>
  <?php   
}
// 관리자로 접속 하지 않았을 경우 사용자 페이지로 이동
if($_SESSION['carnum_front'] != '관리자') {
  ?>
    <script>
        // 관리자가 아닐 경우 사용자 페이지로 이동
        alert("권한이 없습니다");
        location.replace("<?php echo 'user_parking_pot.php'?>");
    </script>
  <?php
}
// 데이터베이스 연동
$connect = mysqli_connect("localhost", "root", "autoset", "valet") ;
$query_money = "select * from customer where out_date != '0000-00-00 00:00:00'";
$result_money = $connect->query($query_money);
while($rows_money = mysqli_fetch_assoc($result_money))
{ 
  $carnum_fronts = $rows_money['carnum_front'];
  $in_Time             = new DateTime($rows_money['in_date'], new DateTimeZone('Asia/Seoul'));  
  $out_Time            = new DateTime($rows_money['out_date'], new DateTimeZone('Asia/Seoul'));                            
  $dateInterval_result = $in_Time->diff($out_Time);
  $money         = 0;                                                // 주차요금 변수 초기화                              
  $date_cal_result     = $dateInterval_result->format('%D일 %H시간 %I분 %S초');
  // 주차 시간 비교하여 주차요금 계산
  $default_time24 = '00-00-01 00:00:00';
  $default_time12 = '00-00-00 12:00:00';
  $default_time08 = '00-00-00 08:00:00';
  $default_time03 = '00-00-00 03:00:00';
  $default_time01 = '00-00-00 01:00:00';
  mysqli_query($connect, "update customer set park_time='$date_cal_result' where carnum_front='$carnum_fronts'");      // 출차시간~입차시간
  $real_out_time = $dateInterval_result->format('%Y-%M-%D %H:%I:%S');    // 입차시간~출차시간

  // 주차 시간 비교 후 money에 요금을 시간마다 넣어주기
  if($real_out_time >= $default_time24){              // 1일 
    $money = 20000;
    
  }
  else if($real_out_time >= $default_time12){         // 12시간
    $money = 10000;
    
  }else if($real_out_time >= $default_time08){        // 8시간
    $money = 8000;
    
  }else if($real_out_time >= $default_time03){        // 3시간
    $money = 5000;
    
  }
  else if($real_out_time >= $default_time01){         // 1시간
    $money = 2000;
  }   
  mysqli_query($connect, "update customer set park_charge='$money' where carnum_front='$carnum_fronts'");

}

$query = "SELECT * FROM customer where 1";
$myslq_str = "";



if($_GET['start_date'] && $_GET['end_date'])
{
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];  
  $myslq_str = "and out_date >= '$start_date' and out_date <= '$end_date' ";
}

if($_GET['check'] == 'day' || !$_GET['check'])
{
  $query = "select DAYOFWEEK(out_date) as week, count(DAYOFWEEK(out_date)) as count, sum(park_charge) as sum from customer where out_date != '0000-00-00 00:00:00'";
  $query .= $myslq_str;
  $query .= "group by DAYOFWEEK(out_date)";

  $result = $connect->query($query);
  $week_car1 = 0;
  $week_car2 = 0;
  $week_car3 = 0;
  $week_car4 = 0;
  $week_car5 = 0;
  $week_car6 = 0;
  $week_car7 = 0;
  
  $week_money1 = 0;
  $week_money2 = 0;
  $week_money3 = 0;
  $week_money4 = 0;
  $week_money5 = 0;
  $week_money6 = 0;
  $week_money7 = 0;
  
  while($rows = mysqli_fetch_assoc($result))
  {
    if($rows['week'] == 1){$week_car1 = $rows['count']; $week_money1 = $rows['sum'];}
    else if($rows['week'] == 2){$week_car2 = $rows['count'];$week_money2 = $rows['sum'];}
    else if($rows['week'] == 3){$week_car3 = $rows['count'];$week_money3 = $rows['sum'];}
    else if($rows['week'] == 4){$week_car4 = $rows['count'];$week_money4 = $rows['sum'];}
    else if($rows['week'] == 5){$week_car5 = $rows['count'];$week_money5 = $rows['sum'];}
    else if($rows['week'] == 6){$week_car6 = $rows['count'];$week_money6 = $rows['sum'];}
    else if($rows['week'] == 7){$week_car7 = $rows['count'];$week_money7 = $rows['sum'];}
  }
}
else if($_GET['check'] == 'month')
{
  $query = "select date_format(out_date, '%m') as month, count(date_format(out_date, '%m')) as count, sum(park_charge) as sum from customer where out_date != '0000-00-00 00:00:00'";
  $query .= $myslq_str;
  $query .= "group by date_format(out_date, '%m')";
  $result = $connect->query($query);
  $month_car1 = 0;
  $month_car2 = 0;
  $month_car3 = 0;
  $month_car4 = 0;
  $month_car5 = 0;
  $month_car6 = 0;
  $month_car7 = 0;
  $month_car8 = 0;
  $month_car9 = 0;
  $month_car10 = 0;
  $month_car11 = 0;
  $month_car12 = 0;

  $month_money1 = 0;
  $month_money2 = 0;
  $month_money3 = 0;
  $month_money4 = 0;
  $month_money5 = 0;
  $month_money6 = 0;
  $month_money7 = 0;
  $month_money8 = 0;
  $month_money9 = 0;
  $month_money10 = 0;
  $month_money11 = 0;
  $month_money12 = 0;
  while($rows = mysqli_fetch_assoc($result))
  {
    if($rows['month'] == 1){$month_car1 = $rows['count']; $month_money1 = $rows['sum'];}
    else if($rows['month'] == 2){$month_car2 = $rows['count']; $month_money2 = $rows['sum'];}
    else if($rows['month'] == 3){$month_car3 = $rows['count']; $month_money3 = $rows['sum'];}
    else if($rows['month'] == 4){$month_car4 = $rows['count']; $month_money4 = $rows['sum'];}
    else if($rows['month'] == 5){$month_car5 = $rows['count']; $month_money5 = $rows['sum'];}
    else if($rows['month'] == 6){$month_car6 = $rows['count']; $month_money6 = $rows['sum'];}
    else if($rows['month'] == 7){$month_car7 = $rows['count']; $month_money7 = $rows['sum'];}
    else if($rows['month'] == 8){$month_car8 = $rows['count']; $month_money8 = $rows['sum'];}
    else if($rows['month'] == 9){$month_car9 = $rows['count']; $month_money9 = $rows['sum'];}
    else if($rows['month'] == 10){$month_car10 = $rows['count']; $month_money10 = $rows['sum'];}
    else if($rows['month'] == 11){$month_car11 = $rows['count']; $month_money11 = $rows['sum'];}
    else if($rows['month'] == 12){$month_car12 = $rows['count']; $month_money12 = $rows['sum'];}
  }
}
else if($_GET['check'] == 'year')
{
  $query = "select date_format(out_date, '%Y') as year, count(date_format(out_date, '%Y')) as count, sum(park_charge) as sum from customer where out_date != '0000-00-00 00:00:00'";
  $query .= $myslq_str;
  $query .= "group by date_format(out_date, '%Y')";
  $result = $connect->query($query);
  $year_car1 = 0;
  $year_car2 = 0;
  $year_car3 = 0;
  $year_car4 = 0;

  $year_money1 = 0;
  $year_money2 = 0;
  $year_money3 = 0;
  $year_money4 = 0;

  while($rows = mysqli_fetch_assoc($result))
  {
    if($rows['year'] == 2017){$year_car1 = $rows['count']; $year_money1 = $rows['sum'];}
    else if($rows['year'] == 2018){$year_car2 = $rows['count']; $year_money2 = $rows['sum'];}
    else if($rows['year'] == 2019){$year_car3 = $rows['count']; $year_money3 = $rows['sum'];}
    else if($rows['year'] == 2020){$year_car4 = $rows['count']; $year_money4 = $rows['sum'];}
  }
}




?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>V.P.P</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="../default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
    <!-- <script src="../JS/graph.js"></script> -->
    <script>
/*********************************************************************************/
/* Money_day                                                                     */
/*********************************************************************************/
window.addEventListener('load', () => {
let money_day_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Money Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your money',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 제목 위치 margin */
      plotarea: {
        margin: '110 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Day',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:100000:20000',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          // 내가고쳐야할부분
          values: [<?echo $week_money1;?>,<?echo $week_money2;?>,<?echo $week_money3;?>,<?echo $week_money4;?>,<?echo $week_money5;?>,<?echo $week_money6;?>,<?echo $week_money7;?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'money_day',
  data: money_day_chart,
  height: '100%',
  width: '100%'
});
});


/*********************************************************************************/
/* Car_day                                                                       */
/*********************************************************************************/
window.addEventListener('load', () => {
let Car_day_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Car Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your money',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 제목 위치 margin */
      plotarea: {
        margin: '110 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Day',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:10:2',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          // 내가고쳐야할부분
          values: [<?echo $week_car1?>,<?echo $week_car2?>,<?echo $week_car3?>,<?echo $week_car4?>,<?echo $week_car5?>,<?echo $week_car6?>,<?echo $week_car7?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'car_day',
  data: Car_day_chart,
  height: '100%',
  width: '100%'
});
});


/*********************************************************************************/
/* Money_month                                                                   */
/*********************************************************************************/
window.addEventListener('load', () => {
let money_month_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Money Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your money',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 제목 위치 margin */
      plotarea: {
        margin: '110 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nob', 'Dec'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Month',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:100000:20000',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          // 내가고쳐야할부분
          values: [<?echo $month_money1?>,<?echo $month_money2?>,<?echo $month_money3?>,<?echo $month_money4?>,<?echo $month_money5?>,<?echo $month_money6?>,<?echo $month_money7?>,<?echo $month_money8?>,<?echo $month_money9?>,<?echo $month_money10?>,<?echo $month_money11?>,<?echo $month_money12?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'money_month',
  data: money_month_chart,
  height: '100%',
  width: '100%'
});
});


/*********************************************************************************/
/* Car_month                                                                     */
/*********************************************************************************/
window.addEventListener('load', () => {

let car_month_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Car Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your car',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 위치 margin */
      plotarea: {
        margin: '120 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nob', 'Dec'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Month',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:10:2',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          //내가고쳐야할부분
          values: [<?echo $month_car1?>,<?echo $month_car2?>,<?echo $month_car3?>,<?echo $month_car4?>,<?echo $month_car5?>,<?echo $month_car6?>,<?echo $month_car7?>,<?echo $month_car8?>,<?echo $month_car9?>,<?echo $month_car10?>,<?echo $month_car11?>,<?echo $month_car12?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'car_month',
  data: car_month_chart,
  height: '100%',
  width: '100%'
});
});


/*********************************************************************************/
/* Money_Year                                                                    */
/*********************************************************************************/
window.addEventListener('load', () => {
let money_year_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Money Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your money',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 제목 위치 margin */
      plotarea: {
        margin: '110 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['2017','2018','2019','2020'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Month',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:200000:40000',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          
          // 내가고쳐야할부분
          values: [<?echo $year_money1?>,<?echo $year_money2?>,<?echo $year_money3?>,<?echo $year_money4?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'money_year',
  data: money_year_chart,
  height: '100%',
  width: '100%'
});
});

/*********************************************************************************/
/* Car_Year                                                                    */
/*********************************************************************************/
window.addEventListener('load', () => {
let Car_year_chart = {
  graphset: [
    // 제목
    {
      type: 'area',
      title: {
        text: 'Car Chart',
        color: '#5D7D9A',
        align: 'left',
        padding: '30 0 0 35',
        fontSize: '30px'
      },
      // 서브 제목
      subtitle: {
        text: 'please check your car',
        color: '#5D7D9A',
        fontWeight: 300,
        align: 'left',
        padding: '35 0 0 35',
        fontSize: '15px'
      },
      // 모르겠담
      tooltip: {
        visible: false
      },
      /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
      crosshairX: {
        plotLabel: {
          fontColor: '#333',
          backgroundColor: '#fff',
          borderRadius: 5,
          borderColor: '#EEE',
          padding: 10
        },
        // 숫자 띄울 시 더 예쁘게 보이기 위함
        'scaleLabel': {
          alpha: 0,
          text: '%v',
          transform: {
            type: 'date',
            all: '%M %d, %Y<br>%g:%i %a'
          },
          fontFamily: 'Georgia'
        }
      },
      /* 그래프 제목 위치 margin */
      plotarea: {
        margin: '110 40 60 80'
      },
      // 모르겠담 - 없어도 달라지지 않음
      _legend: {
        layout: '2x2',
        align: 'right',
        'verticalAlign': 'top',
        margin: '10 40 0 0',
        padding: '5px',
        borderRadius: '5px',
        header: {
          text: 'Legend',
          color: '#5D7D9A',
          padding: '10px'
        },
        item: {
          color: '#5D7D9A'
        }
      },
      /** x축 */
      scaleX: {
        labels: ['2017','2018','2019','2020'],
        // 이건 뭐지? - 없어도 달라지지 않음
        label: {
          color: '#6C6C6C'
        },
        lineColor: '#D8D8D8',
        // x축 막대기색
        tick: {
          lineColor: '#D8D8D8'
        },
        // x축 글자색
        item: {
          color: '#6C6C6C'
        },
        // x축 밑 라벨 조정
        label: {
          padding: '20 0 0 0',
          text: 'Month',
          color: '#6C6C6C'
        },
        // 전부 나오게 하기
        maxItems: 999
      },
      // 그래프 관련
      plot: {
        // 투명도
        alphaArea: 0.4,
        // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
        stacked: false,
        // 그래프 크로스헤어 크기
        marker: {
          size: 4
        }
      },
      /** Y축  */
      scaleY: {
        maxItems: 8,
        // Y축 세로선 색
        lineColor: '#D8D8D8',
        // y축 크기 배분
        values: '0:10:2',
        guide: {
          'lineStyle': 'solid'
        },
        // y축 막대기 색
        tick: {
          lineColor: '#D8D8D8'
        },
        // y축 글자색
        item: {
          color: '#6C6C6C'
        },
      },
      // 값 입력
      series: [
        {
          //내가고쳐야할부분
          values: [<?echo $year_car1?>,<?echo $year_car2?>,<?echo $year_car3?>,<?echo $year_car4?>],
          lineColor: '#94DBF9',
          backgroundColor: '#94DBF9',
          marker: {
            backgroundColor: '#94DBF9',
            borderColor: '#94DBF9'
          }
        }
      ]
    }
  ]
};

// render chart
zingchart.render({
  id: 'car_year',
  data: Car_year_chart,
  height: '100%',
  width: '100%'
});
});
    </script>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> 
  </head>
  <body>
    <div id="page" class="container">
        <div id="header">
          <!-- 왼쪽 위 로고 -->
          <div id="logo">
              <img src="../images/fire.jpg" />&nbsp;&nbsp;&nbsp;
              <a href="../index.php">V.P.P</a>
          </div>
          <div id="profile">
              <div id = "graph_search">
                <form id = "checkbox">
                    <form id = "checkbutton_day" action="admin_graph.php" method="get">
                      <input type="hidden" id="check_day" name="check" value="day" />
                      <?
                        if($_GET['start_date'] && $_GET['end_date'])
                        {
                          ?>
                              <input type="hidden" name="start_date" value = '<?echo $_GET['start_date']?>' />
                              <input type="hidden" name="end_date" value = '<?echo $_GET['end_date']?>' />
                          <?
                        }
                      ?>
                      <button class="check_button">Day</button>
                      
                    </form>
                    <form id = "checkbutton_month" action="admin_graph.php" method="get">
                      <input type="hidden" id="check_month" name="check" class="check_button" value="month" />
                      <?
                        if($_GET['start_date'] && $_GET['end_date'])
                        {
                          ?>
                              <input type="hidden" name="start_date" value = '<?echo $_GET['start_date']?>' />
                              <input type="hidden" name="end_date" value = '<?echo $_GET['end_date']?>' />
                          <?
                        }
                      ?>
                      <button class="check_button">Month</button>
                    </form>
                    <form id = "checkbutton_year" action="admin_graph.php" method="get">
                      <input type="hidden" id="check_year" name="check" class="check_button"value="year" />
                      <?
                        if($_GET['start_date'] && $_GET['end_date'])
                        {
                          ?>
                              <input type="hidden" name="start_date" value = '<?echo $_GET['start_date']?>' />
                              <input type="hidden" name="end_date" value = '<?echo $_GET['end_date']?>' />
                          <?
                        }
                      ?>
                      <button class="check_button">Year</button>
                    </form>
                    
                          <div id = "graph_date_box">
                            <form action="admin_graph.php" action="get">
                            <?
                                  if($_GET['check'] == 'day')
                                  {
                                    ?>
                                      <input type="hidden" name="check" value = '<?echo $_GET['check']?>' />
                                    <?
                                  }else if($_GET['check'] == 'month'){
                                    ?>
                                      <input type="hidden" name="check" value = '<?echo $_GET['check']?>' />
                                    <?
                                  }else if($_GET['check'] == 'year'){
                                    ?>
                                      <input type="hidden" name="check" value = '<?echo $_GET['check']?>' />
                                    <?
                                  }

                                ?> 
                                <input type="date" name = 'start_date' id="start_date">
                                <input type="date" name = 'end_date' id="end_date">
                                <button class="ok">ok</button>
                            </form>
                          </div>
                      <?
                    
                    ?>  
                    </form>
                    <script>
                      // 오늘 날짜 넣기
                      document.getElementById('start_date').valueAsDate = new Date();
                      document.getElementById('end_date').valueAsDate = new Date();
                    </script>
                </form>
                <div id = "search_what">
                    <fieldset>찾을 날짜를 선택하세요</fieldset>
                </div>
              </div>
              
              <ul>
              <? 
                // 검색해서 찾은 차량이 4자리 번호가 겹치는 것이 있으면 겹치는 차량 목록을 보여줌
                
                // 검색해서 찾은 차량이 1대일 경우
                
                    ?>
                      <!-- 새로 고침 -->
                    <div id="f5_box3">
                      <a href ="admin_graph.php" id="f5">
                          <img src='../images/f5_icon_default_circle.png' />
                      </a>
                    </div>
                    <div id = "user_image">
                      <img src="../images/user.jpg" />
                    </div>
                    <div class="car_num">
                      <li>관리자</li>
                    </div>
                    <div class="profile_content">
                      <li>누적된 주차 자동차 수 : 
                          <?php
                            $query ="select * from customer";
                            $result_set = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($result_set);
                            echo $count.'<br>';
                          ?>
                      </li>
                      <li>현재 주차 된 자동차 수 : 
                          <?php
                            $query ="select * from customer where out_date = '0000-00-00 00:00:00'";
                            $result_set = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($result_set);
                            echo $count.'<br>';
                          ?>
                      </li>
                      <li>금일 들어온 자동차 수 : 
                          <?php
                            $in_time_sum = date('Y-m-d');
                            $query ="select * from customer where DATE(in_date) = '$in_time_sum'";
                            $result_set = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($result_set);
                            echo $count.'<br>';
                    ?>
                      </li>
                    </div> 
              </ul>
              <button class="btn_logout" onclick="location.href='../logout.php'">로그아웃</button>
          <?
              
          ?>
          </div>
          <div id="menu">
              <ul>
                <li class="who_use">관리자</li>
                <li><a href="admin_parking_pot.php" accesskey="4" title="">현재 주차장 현황</a></li>
                <li><a href="admin_gate.php" accesskey="5" title="">출입 기록</a></li>
                <li class="current_page_item"><a href="admin_graph.php" accesskey="6" title="">Admin_graph</a></li>
              </ul>
          </div>
        </div>
        <div id="main">
          <?if(!$_GET['check'] || $_GET['check'] == 'day'){?>
          <div id="money_day" class="chart--container">
          </div>
          <div id="car_day" class="chart--container">
          </div>
          <?}else if($_GET['check'] == 'month'){?>
          <div id="money_month" class="chart--container">
          </div>
          <div id="car_month" class="chart--container">
          </div>
          <?}else if($_GET['check'] == 'year'){?>
          <div id="money_year" class="chart--container">
          </div>
          <div id="car_year" class="chart--container">
          </div>
          <?}?>
        </div>
    </div>
  </body>
</html>