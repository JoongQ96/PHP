<?

// $connect = mysqli_connect("localhost", "root", "autoset", "valet") ;

// $query ="select * from customer where out_date = '0000-00-00 00:00:00' and carnum_front = '$search'";
// $result = $connect->query($query);
// $area = $search_row['park_area'].$search_row['park_loc'];

$connect = mysqli_connect("localhost", "root", "autoset", "valet02") ;



?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>V.P.P</title>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.2/dist/vue.js"></script>
        <script src="https://unpkg.com/vue-router@3.0.1/dist/vue-router.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link
            href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900"
            rel="stylesheet"/>
        <link href="../default.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="../fonts.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="../Home.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <meta HTTP-EQUIV="refresh" CONTENT="10" /> 
    </head>

    <body>
        <!-- 왼쪽 네비게이터 -->
        <div id="page" class="container">
            <div id="main_user_park">
            <div id="user_parking_font">
               <span class = "font_blank2">A</span>
               <span class = "font_blank1">A</span>
               <span class = "font_blank2">B</span>
               <span class = "font_blank1">B</span>
            </div>
            <div id="welcome">
               <div class="title">
               <!-- A구역에 table구성 -->
               <div id = 'Atable'>
                  
                  
               </div>
               <div id = 'Btable'>
                  <table border = 1 class = "user_park_table" >
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
                        $query ="select * from user_park";
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
                                 echo 'car_a';
                                 // 차량이 있으면 num값을 더함(num값의 총 개수는 B구역의 총 주차 수)
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
                           else
                              echo $place."0";
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

               <?
               $connect0 = mysqli_connect("localhost", "root", "autoset", "valet02") ;

               $query0 ="select * from customer";
               $result0 = $connect0->query($query0);

               ?>
               <div id = 'Atable'>
                  <table border = 1 class = "user_park_table" >
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
                        $query ="select * from user_park";
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
                                 echo 'car_a';
                                 // 차량이 있으면 num값을 더함(num값의 총 개수는 B구역의 총 주차 수)
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
                           else
                           echo $place."0";
                              //    글자는 해당 주차구역과 주차번호를 나타냄
                           }?></a>
                        </span>
                        </td>
                     </tr>
                  </table>
               </div>

               
               <div id = 'Btable'>
                  <table border = 1 class = "user_park_table" >
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
                        $query ="select * from user_park";
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
                           if($number <= 6)
                              echo $place.$number;
                           else
                              echo $place."0";
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
               <?
                  while($rows0 = mysqli_fetch_assoc($result0)){
                  if($rows0['Area'] == 'A'){
                     if($rows0['Left_Parking'] >= 12) {
                        ?>
                        <div class = "direction_point_red direction_point_B" ></div>                               
                        <?php
                        break;
                     }
                     else if($rows0['Be_Parking'] + $rows0['Left_Parking'] >= 12 ) {
                        ?>
                        <div class = "direction_point_red direction_point_B" ></div>                               
                        <?php
                        break;
                     }
                     else if($rows0['Be_Parking'] < 12 && $rows0['Be_Parking'] != 0) {
                        ?>
                        <div class = "direction_point_orange direction_point_B" ></div>                               
                        <?php
                        break;
                     }
                     else{
                        ?>
                        <div class = "direction_point_default direction_point_B" ></div>
                        <?php
                        break;
                     }
                  
                  }
               }?>
            
               
               <div id = 'Btable'>
                  <table border = 1 class = "user_park_table" >
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
                        $query ="select * from user_park";
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
                              else
                                 echo $place."0";
                     }?>
                           </a>
                           </span>
                        </td>
                     </tr>
                  </table>
               </div>

               <!-- C 화살표 -->
               <div class = "direction_point_default direction_point_C" ></div>
               
               <?
                  while($rows0 = mysqli_fetch_assoc($result0))
                  {
                     if($rows0['Area'] == 'B'){
                        if($rows0['Left_Parking'] >= 12) {
                           ?>
                           <div class = "direction_point_red direction_point_C" ></div>                               
                           <?php
                           break;
                        }
                        else if($rows0['Be_Parking'] + $rows0['Left_Parking'] >= 12 ) {
                           ?>
                           <div class = "direction_point_red direction_point_C" ></div>                              
                           <?php
                           break;
                        }
                        else if($rows0['Be_Parking'] < 12 && $rows0['Be_Parking'] != 0) {
                           ?>
                           <div class = "direction_point_orange direction_point_C" ></div>                               
                           <?php
                           break;
                        }
                        else{
                           ?>
                           <div class = "direction_point_default direction_point_C" ></div>
                           <?php
                           break;
                        }
                  
                  }
               }?>

            </div>
         </div>
         </div>
         </div>
    </body>
</html>