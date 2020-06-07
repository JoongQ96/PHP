<?session_start();
$connect = mysqli_connect('localhost', 'root', 'autoset', 'valet') or die("fail");
$carnum_front = 'xxxx';
// 입력 받은 차량번호
if($_GET['number'])
{
	$carnum_front = $_GET['number'];
}
$query  = "select * from customer where carnum_front LIKE '%$carnum_front' and out_date = 0000-00-00";
$result = $connect->query($query);
$rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>V.P.P</title>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
	<link href="mobile.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
	<script src="Home.js"></script>
</head>
<body>
<!-- 왼쪽 네비게이터 -->
<div id="page" class="container">
	<!-- 왼쪽 위 로고 -->
	<div id="logo">
		<img src="images/fire.jpg" />&nbsp;&nbsp;&nbsp;
		<a href="index.php">V.P.P</a>
	</div>
</div>
<div id="main">
	<dv id="welcome">
		<div class="title">
		<?php if(!isset($_SESSION['carnum_front'])) { ?>	
		<form method="get" id="authForm" action='page/login_ok.php'>
			<input type="hidden" name="redirectUrl">
			<fieldset id="login_field_find" style='text-align: center'>
				<div class="center">
				<?
					
				if($rows >= 1)
				{
                    while($row = mysqli_fetch_assoc($result)){
						$carnum = $row['carnum_front'];
						?>
							<button type="button" class="find_button" onclick="location.href='page/login_ok.php?carnum_front=<?echo $carnum;?>'" ><div class='eff'></div><span><?echo $carnum;?></span></button>
                        <?
                        }
				}else{
					?>
						<script>
        					alert("차량 정보가 없습니다");
        					location.replace("index.php");
    					</script>
					<?php
				}		
			   ?>
			   </div>
			</fieldset>
		</form>
		<?php }else
		{
			?>
				<script>
        			alert("로그인 되었습니다");
        			location.replace("page/user_parking_pot.php");
    			</script>
			<?php
	 	} ?>
		</div>
	</div>
</div>
<div id="app">
</div>
</body>
</html>
