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
// board를 검색하고 번호가 큰순서대로 정렬하기 구문을 변수로 지정
if($_GET['search']){
   // 검색한 값을 get으로 받음
   $search = $_GET['search'];
   // 차량의 번호를 전부 입력받거나 뒤 4자리를 검색
   $query ="select distinct carnum_front from customer where carnum_front LIKE '%$search'";
   $result = $connect->query($query);
   // 차량의 번호의 4자리가 공통된 차량 대수를 search_rows에 담음
   $search_rows = mysqli_num_rows($result);
}
// 데이터베이스에 입장 날자를 기준으로 정렬
$query ="select * from customer order by in_date desc"; 
$result = $connect->query($query);
// 차량의 기록된 값을 테이블의 열의 개수를 변수로 지정
$total = mysqli_num_rows($result);
$i_total = $total;

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
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
      <link href="../default.css" rel="stylesheet" type="text/css" media="all" />
      <link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
      <script src="../Home.js"></script>
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
               <div id = "profile_search">
                  <form id = "checkbox">
                     <input type="checkbox" id="ch1" checked>
                     <label for="ch1"><span></span>차 번호</label>
                     <input type="checkbox" id="ch2" checked>
                     <label for="ch2"><span></span>날짜</label>
                     <?
                     //검색을 했을 때 찾는 번호와 겹치는게 1대 밖에 없거나, 찾지 않았을 경우
                     if($search_rows == 1 || !$_GET['search'])
                     {
                        ?>
                           <div id = "date_box">
                              <form action="admin_gate.php" action="get">
                                 <fieldset>입장시간 기준</fieldset>
                                 <input type="date" name = 'date_in_1' id="date_in_1">
                                 <input type="date" name = 'date_in_2' id="date_in_2">
                                 <?
                                 // 나가는 시간이 검색 되었으면 get으로 누적시켜서 검색
                                 if($_GET['date_out_1'] && $_GET['date_out_2'])
                                 {
                                    ?>
                                       <input type="hidden" name="date_in_1" value = '<?echo $_GET['date_in_1']?>' />
                                       <input type="hidden" name="date_in_2" value = '<?echo $_GET['date_in_2']?>' />
                                    <?
                                 }
                                 // 차량을 검색 됐으면 get으로 누적시켜서 검색
                                 if($_GET['search'])
                                 {
                                    ?> 
                                       <input type="hidden" name="search" value = '<?echo $_GET['search']?>' />
                                    <?
                                 }
                                 ?> 
                                 <button class="ok">ok</button>
                              </form>
                              
                              <form action="admin_gate.php" action="get">
                                 <fieldset>나간시간 기준</fieldset>
                                 <input type="date" name = 'date_out_1' id="date_out_1">
                                 <input type="date" name = 'date_out_2' id="date_out_2">
                                 <? 
                                    // 입장 시간이 검색 되었으면 get으로 누적시켜서 검색
                                    if($_GET['date_in_1'] && $_GET['date_in_2'])
                                    {
                                       ?>
                                          <input type="hidden" name="date_in_1" value = '<?echo $_GET['date_in_1']?>' />
                                          <input type="hidden" name="date_in_2" value = '<?echo $_GET['date_in_2']?>' />
                                       <?
                                    }
                                    // 차량 검색 되었으면 get으로 누적시켜서 검색
                                    if($_GET['search'])
                                    {
                                       ?>
                                       <input type="hidden" name="search" value = '<?echo $_GET['search']?>' />
                                       <?
                                    }
                                 ?>
                                 <button class="ok">ok</button>
                              </form>
                           </div>
                        <?
                     }
                     ?>  
                     </form>
                     <script>
                        // 오늘 날짜 넣기
                        document.getElementById('date_in_1').valueAsDate = new Date();
                        document.getElementById('date_in_2').valueAsDate = new Date();
                        document.getElementById('date_out_1').valueAsDate = new Date();
                        document.getElementById('date_out_2').valueAsDate = new Date();
                     </script>
                  </form>
                  <form action="admin_gate.php?" action="get">
                     <input type="search" id="search" name="search" placeholder="Type Full Car Number or Last 4 Number..." />
                     <?
                     // 입장 시간이 검색 되었으면 get으로 누적시켜서 검색
                     if($_GET['date_in_1'] && $_GET['date_in_2'])
                     {
                        ?>
                           <input type="hidden" name="date_in_1" value = '<?echo $_GET['date_in_1']?>' />
                           <input type="hidden" name="date_in_2" value = '<?echo $_GET['date_in_2']?>' />
                        <?
                     }
                     // 나간 시간이 검색 되었으면 get으로 누적시켜서 검색
                     if($_GET['date_out_1'] && $_GET['date_out_2'])
                     {
                        ?>
                        <input type="hidden" name="date_out_1" value = '<?echo $_GET['date_out_1']?>' />
                        <input type="hidden" name="date_out_2" value = '<?echo $_GET['date_out_2']?>' />
                        <?
                     }?>
                     <button class="icon"><i class="fa fa-search"></i></button>
                  </form>
               </div>
               
               <ul>
               <? 
                  // 검색해서 찾은 차량이 4자리 번호가 겹치는 것이 있으면 겹치는 차량 목록을 보여줌
                  if($search_rows >= 2)
                  {  
                     $query ="select distinct carnum_front from customer where carnum_front LIKE '%$search'";
                     $result = $connect->query($query);
                     while($row = mysqli_fetch_assoc($result))
                     {
                        $carnum = $row['carnum_front'];
                        // 겹치는 차량 목록을 버튼식으로 하고 버튼을 클릭하였을 때 해당 차량정보로 이동
                        ?>
                           <button type="button" class="find_button" onclick="location.href='admin_gate.php?search=<?echo $carnum;?><?if($_GET['date_in_1'] && $_GET['date_in_2']){echo '&date_in_1='.$_GET['date_in_1'].'&date_in_2='.$_GET['date_in_2'];}if($_GET['date_out_1'] && $_GET['date_out_2']){echo '&date_out_1='.$_GET['date_out_1'].'&date_out_2='.$_GET['date_out_2'];}?>'">
                           <div class='eff'></div><span><?echo $carnum;?></span></button>
                        <?
                     }
                  }
                  // 검색해서 찾은 차량이 1대일 경우
                  else
                  {
                     ?>
                        <!-- 새로 고침 -->
                     <div id="f5_box2">
                        <a href ="admin_gate.php" id="f5">
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
               }
            ?>
            </div>
            <div id="menu">
               <ul>
                  <li class="who_use">관리자</li>
                  <li><a href="admin_parking_pot.php" accesskey="4" title="">현재 주차장 현황</a></li>
                  <li class="current_page_item"><a href="admin_gate.php" accesskey="5" title="">출입 기록</a></li>
                  <li><a href="admin_graph.php" accesskey="6" title="">Admin_graph</a></li>
               </ul>
            </div>
         </div>
         <div id="main">
            <table id = "admin_table_gate" align = center>
            <thead align = "center">
            <tr>
            <td class="admin_table_gate_num admin_table_gate_head">번호</td>
            <td class="admin_table_gate_car_num admin_table_gate_head">차량번호</td>
            <td class="admin_table_gate_intime admin_table_gate_head">입장시간</td>
            <td class="admin_table_gate_outtime admin_table_gate_head">나간시간</td>
            <td class="admin_table_gate_loc admin_table_gate_head">주차요금</td>
            </tr>
            </thead>
      
            <tbody>
            <?php   
               //게시판 페이징 
               //page get값이 없을 경우 1페이지로 설정
               if(!$_GET['page'])
               {   
                  $_GET['page'] = 1;   
               }    
               // 기본 검색문 + get값이 있는 값들을 검색
               $query ="select * from customer where 1 ";
               // 차량 번호 검색 값이 있으면 해당 값을 차량들만 검색
               if($_GET['search'])
               {
                  $search = $_GET['search'];
                  $query .= "and carnum_front = '$search' ";
               }
               // 입장 날짜 범위가 검색되었으면 해당 날짜 값들을 검색
               if($_GET['date_in_1'] && $_GET['date_in_2'])
               {
                  $date_in_1 = $_GET['date_in_1'];
                  $date_in_2 = $_GET['date_in_2'];  
                  $query .= "and in_date >= '$date_in_1' and in_date <= '$date_in_2' ";
               }
               // 나간 날짜 범위가 검색되었으면 해당 날짜 값들을 검색
               if($_GET['date_out_1'] && $_GET['date_out_2'])
               {
                  $date_out_1 = $_GET['date_out_1'];
                  $date_out_2 = $_GET['date_out_2'];  
                  $query .= "and out_date >= '$date_out_1' and out_date <= '$date_out_2' ";
               }         
               // 입장 시간 기준으로 검색
               $query .= "order by in_date desc";
               $result = $connect->query($query);
               $total = mysqli_num_rows($result);
               $i_total = $total;
               
               while($rows = mysqli_fetch_assoc($result))
               { 
                  //페이징을 통해 10개씩만 보여줌
                  for($i = 1 ; $i <= $i_total/10+1 ; $i++)
                  {  
                     if($total <= $i_total - (($i-1)*10) && $total >= ($i_total - (($i-1)*10))-9 )
                     {  
                        //page를 get으로 받았을 경우 해당 페이지에서 10개 목록을 보여줌 
                        if($_GET['page'] == $i)
                        {         
                           // 목록의 순서에서 홀수에다가 색을 입힘 
                           if($total%2==1)
                           {
                              ?>             
                                 <tr class = "even">
                              <?
                           }
                           else
                           {
                              ?>
                                 <tr>
                              <?
                           }  
                              ?>
                           <td class="admin_table_gate_num row">
                           <?php echo $total?></td>
                           <!-- 제목가져오기  -->
                           <td class="admin_table_gate_car_num row">
                           <?php echo $rows['carnum_front']?></td>
                           <!-- 입장 날짜 시간 출력   -->
                           <td class="admin_table_gate_intime row"><?php echo $rows['in_date']?></td>
                           <!-- 나간 날짜 시간 출력 -->
                           <td class="admin_table_gate_outtime row"><?php echo $rows['out_date']?></td>
                           <!-- 위치 출력 -->
                           <td class="admin_table_gate_loc row">
                           <?php
         
                              // 입차시간~현재시간 비교
                              $carnum_fronts       = $rows['carnum_front'];
                              $now                 = date("Y-m-d H:i:s", time());                                     // 현재시간을 연 월 일 시간 분 초 
                              
                              $in_Time             = new DateTime($rows['in_date'], new DateTimeZone('Asia/Seoul'));  // 입차 시간(들어간 시간을 한국시간으로 객체화)
                              $now_Time            = new DateTime($now, new DateTimeZone('Asia/Seoul'));              // 현재 시간(현  재 시간을 한국시간으로 객체화)
                              $dateInterval        = $in_Time->diff($now_Time);                                       // 주차시간 =  현재 시간 - 입장시간
                              
                              // 입차시간~출차시간 비교...
                              $out_Time            = new DateTime($rows['out_date'], new DateTimeZone('Asia/Seoul')); // 출차 시간(들어간 시간을 한국시간으로 객체화)                              
                              $dateInterval_result = $in_Time->diff($out_Time);                                       // 주차시간 =  퇴장 시간 - 입장시간

                              $money         = 0;                                                // 주차요금 변수 초기화                              
                              // 입차시간~현재시간의 변수
                              $date_cal            = $dateInterval->format('%D일 %H시간 %I분 %S초');
                              $date_cal_result     = $dateInterval_result->format('%D일 %H시간 %I분 %S초');


                              // 주차 시간 비교하여 주차요금 계산
                              $default_time24 = '00-00-01 00:00:00';
                              $default_time12 = '00-00-00 12:00:00';
                              $default_time08 = '00-00-00 08:00:00';
                              $default_time03 = '00-00-00 03:00:00';
                              $default_time01 = '00-00-00 01:00:00';
                              
                              if($rows['out_date'] == '0000-00-00 00:00:00'){

                                 mysqli_query($connect, "update customer set park_time='$date_cal' where carnum_front='$carnum_fronts'");             // 현재시간~입장시간
                                 $default_time  = $dateInterval->format('%Y-%M-%D %H:%I:%S');       // 입차시간~현재시간


                                 // 주차 시간 비교 후 money에 요금을 시간마다 넣어주기
                                 if($default_time >= $default_time24){              // 1일 
                                    $money = 20000;
                                    echo $money."원";
                                 }
                                 else if($default_time >= $default_time12){         // 12시간
                                    $money = 10000;
                                    echo $money."원";
                                 }else if($default_time >= $default_time08){        // 8시간
                                    $money = 8000;
                                    echo $money."원";
                                 }else if($default_time >= $default_time03){        // 3시간
                                    $money = 5000;
                                    echo $money."원";
                                 }
                                 else if($default_time >= $default_time01){         // 1시간
                                    $money = 2000;
                                    echo $money."원";
                                 }   
                                 else{                                              // 기본값
                                    echo $money."원";
                                 }
                               }
                              if($rows['out_date'] != '0000-00-00 00:00:00'){
                              
                                 // 입차시간~출차시간의 변수
                                 mysqli_query($connect, "update customer set park_time='$date_cal_result' where carnum_front='$carnum_fronts'");      // 출차시간~입차시간
                                 $real_out_time = $dateInterval_result->format('%Y-%M-%D %H:%I:%S');    // 입차시간~출차시간

                                 // 주차 시간 비교 후 money에 요금을 시간마다 넣어주기
                                 if($real_out_time >= $default_time24){              // 1일 
                                    $money = 20000;
                                    echo $money."원";
                                 }
                                 else if($real_out_time >= $default_time12){         // 12시간
                                    $money = 10000;
                                    echo $money."원";
                                 }else if($real_out_time >= $default_time08){        // 8시간
                                    $money = 8000;
                                    echo $money."원";
                                 }else if($real_out_time >= $default_time03){        // 3시간
                                    $money = 5000;
                                    echo $money."원";
                                 }
                                 else if($real_out_time >= $default_time01){         // 1시간
                                    $money = 2000;
                                    echo $money."원";
                                 }   
                                 else{                                              // 기본값
                                    echo $money."원";
                                 }
                              }
                              

                              // 주차요금을 데이터베이스에 주차요금 업데이트
                              mysqli_query($connect, "update customer set park_charge='$money' where carnum_front='$carnum_fronts'");
               
               
                           ?>
                           </td>
                        </tr>
                     <?php
                        }
                     } 
                  } 
                  $total--;
               }
            
               ?>
            </tbody>
            </table>
            <?
               // 검색된 페이지 값을 get으로 받아 변수로 만듬      
               if($_GET['page'] && $_GET['page'] > 0)
               {
                  $page = $_GET['page'];
               }
               // 기본 페이지 값은 1
               else
               {
                  $page = 1;
               }
               $page_row = 10;// 한 페이지에 보일 글 수
               $page_scale = 10;// 한줄에 보여질 페이지 수
               $page_num = ceil($i_total/$page_row);//전체 페이지 수
               
               $start_recode = ($page-1)*$page_row;
               
               $paging_str = "";
               if($page>1){
               $paging_str .= "<a class='page_num' href=".$_SERVER['PHP_SELF']."?page=1>[처음]</a>";
               }
               //페이징에 표시될 시작 페이지
               $start_page = ((ceil($page/$page_scale)-1)*$page_scale)+1;
               //페이징에 표시될 마지막 페이지
            
               $end_page = $start_page+$page_scale-1;
               if($end_page >= $page_num){$end_page=$page_num;}
            
               //이전 페이징으로 가는 링크
               if ($start_page > 1)
               {
                  $paging_str .= "<a class='page_num' href='".$_SERVER['PHP_SELF']."?page=".($start_page-1);
                  $paging_str .= "'>[이전]</a>";
               }
               //페이지 출력 부분 링크
               if ($page_num > 1) 
               {
                  for ($i=$start_page;$i<=$end_page;$i++)
                   {
                     // 현재 페이지가 아니면 링크 걸기
                     if ($page != $i)
                     {
                        $paging_str .= "<a class='page_num' href='".$_SERVER['PHP_SELF']."?page=".$i;
                        if($_GET['search'])
                        {
                           $paging_str .= "&search=".$_GET['search'];
                        }
                        if($_GET['date_in_1'] && $_GET['date_in_2'])
                        {
                           $paging_str .= "&date_in_1=".$_GET['date_in_1'];
                           $paging_str .= "&date_in_2=".$_GET['date_in_2'];
                        }
                        if($_GET['date_out_1'] && $_GET['date_out_2'])
                        {
                           $paging_str .= "&date_out_1=".$_GET['date_out_1'];
                           $paging_str .= "&date_out_2=".$_GET['date_out_2']; 
                        }
                        $paging_str .= "'>[$i]</a>";
                     // 현재 페이지면 굵게 표시하기
                     }
                     else
                     {
                        $paging_str .= "<b class='page_num'>[$i]</b>";
                     }
                  }
               }
               //다음 페이징으로 가는 링크
               if ($page_num > $end_page){
                        $paging_str .= "<a class='page_num' href='".$_SERVER['PHP_SELF']."?page=".($end_page+1);
                        $paging_str .= "'>[다음]</a>";
                        
               }
               //마지막 페이지 링크
               if ($page < $page_num)
               {
                  $paging_str .= "<a class='page_num' href='".$_SERVER['PHP_SELF']."?page=".$page_num;
                  $paging_str .= "'>[끝]</a>";
               }
               echo $paging_str;
            ?>

      </div>
   </body>
</html>