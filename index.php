<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
include'functions.php';
if(empty($_SESSION['login']))
    header("location:login.php");
?>

<html>
	<head>
		<title> Diskusi Petani | Sistem Pendukung Keputusan Pemilihan Jenis Tanaman Pangan </title>
		<meta charset='utf-8'>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel='shortcut icon' href='images/fav-icon.jpg'/>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
		<div id='header-wrap'>
			<div id='header'>
				<div id='logo'>
					<a href="?m=beranda">
		            	<img src="images/logo.png"/>
		            </a>
					<div class="admin"> Selamat Datang, Hadi Suhada <br>
						<a href="//localhost/spk-tanaman/website/beranda.php" target="_blank"> Lihat Website </a> | <a href="?m=help"> Help </a> | <a href="actions.php?act=logout"> Logout </a>
					</div>
				</div>
			</div>
		</div>
		<div id='menu-wrap'>
			<div id='menu-padding'>
				<div id='cssmenu'>
					<ul>
						<li class="<?=is_hidden('beranda')?>"><a href="?m=beranda"><b>Beranda</b></a></li>
						<li class="<?=is_hidden('kriteria')?>"><a href="?m=kriteria"><b>Kriteria</b></a></li>
						<li class="<?=is_hidden('jenis_tanaman')?>"><a href="?m=jenis_tanaman"><b>Jenis&nbsp;Tanaman</b></a></li>
						<li class="<?=is_hidden('karakteristik_lahan')?>"><a href="?m=karakteristik_lahan"><b>Karakteristik&nbsp;Lahan</b></a></li>
						<li class="<?=is_hidden('relasi')?>"><a href="?m=relasi"><b>Nilai&nbsp;Alternatif</b></a></li>
						<li class="<?=is_hidden('hitung')?>"><a href="?m=hitung"><b>Perhitungan</b></a></li>
						<li class="<?=is_hidden('user')?>"><a href="?m=user"><b>Manajemen&nbsp;User</b></a></li>
					</ul>
				</div>
			</div>
		</div>

		<?php
			if(file_exists($mod.'.php'))
				include $mod.'.php';
			else
				include 'beranda.php';
		?>

		<div id='footer'>
			<div id='footer-wrap'>
				<div class="cleaner_h20"></div>
					<div align="center">
						Copyright &copy; <?=date('Y')?> Sistem Pendukung Keputusan Pemilihan Jenis Tanaman Pangan <br>
						All Rights Reserved.
					</div>
				<div class="cleaner_h30"></div>
			</div>
		</div>	
	</body>
</html>