<?session_start();?>

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
<?
	if(!$_GET){

	}else if($_GET['number']){
		$carnum_front = $_GET['number'];
		?>        
			<script>

			</script>			
		<?
	}
?>



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
			<div id = "title_name">
				<div id="logo2">
					<img src="images/fire.jpg" />&nbsp;&nbsp;&nbsp;
						<a>V.P.P</a>
				</div>
			</div>
		<?php if(!isset($_SESSION['carnum_front'])) { ?>	
		<form method="get" id="authForm" action='page/login_ok.php'>
			<input type="hidden" name="redirectUrl">
			<fieldset id="login_field">
				<h1>Login</h1>
				<div class="inp_text">
					<input type="text" id="frontId" name="carnum_front" placeholder="last car number (4 character)" >
				</div>
			<button type="submit" class="btn_login" onclick="location.href='page/login_ok.php'">로그인</button>
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
