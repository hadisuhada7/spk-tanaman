<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php include 'functions.php'; ?>

<html>
	<head>
		<title> Login Form | Sistem Pendukung Keputusan Pemilihan Jenis Tanaman Pangan </title>
		<meta charset='utf-8'>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel='shortcut icon' href='images/fav_icon.jpg'/>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
	</head>
	<body id="background-image">
		<div id="login-form">
			<div class="head-loginform"> Login Administrator </div>
			<div class="field-login">
				<form action="?m=login" method="POST">
					<?php if( $_POST ) include'actions.php' ?>
					<label> Username </label><br>
						<input type="text" class="login" name="username" placeHolder="Type Username" required autofocus /><br>
					<label> Password </label><br>
						<input type="password" class="login" name="password" placeHolder="Type Password" required /><br>
						<input type="submit" class="button" value="Login"/> 
						<input type="reset" class="button" value="Cancel"/>
				</form>
			</div>
		</div>
	</body>
</html>