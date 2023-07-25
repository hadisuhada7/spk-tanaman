<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php include 'functions.php';?>

<html>
	<head>
		<title> Diskusi Petani | Laporan Hasil Perhitungan </title>
		<link rel='shortcut icon' href='images/fav_icon.jpg'/>
	</head>
	<body>
		<?php
			$bln = date('m');
			switch($bln){
				case 1:
					$blnnama = "Januari";
					break;
				case 2:
					$blnnama = "Februari";
					break;
				case 3:
					$blnnama = "Maret";
					break;
				case 4:
					$blnnama = "April";
					break;
				case 5:
					$blnnama = "Mei";
					break;
				case 6:
					$blnnama = "Juni";
					break;
				case 7:
					$blnnama = "Juli";
					break;
				case 8:
					$blnnama = "Agustus";
					break;
				case 9:
					$blnnama = "September";
					break;
				case 10:
					$blnnama = "Oktober";
					break;
				case 11:
					$blnnama = "November";
					break;
				case 12:
					$blnnama = "Desember";
					break;
				case 1:
					$blnnama = "Januari";
					break;
			}
		?>
		<?php 
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=laporan_hasil_perhitungan.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
		?>				
		<center><h4> Laporan Hasil Perhitungan <br> Jenis Tanaman Pangan Menggunakan Metode <i> Promethee </i> <br> Tanggal <?php echo date('d'); echo " "; echo $blnnama; echo " "; echo date('Y'); ?></h4></center>
		<table width="75%" border="solid" bgcolor="white" align="center">
			<tr style="font-weight:bold;" bgcolor="orange" align="center">
				<th> Rank </th>
				<th> Id. Tanaman </th>
				<th> Nama Tanaman </th>
                <th> Leaving Flow </th>
                <th> Entering Flow </th>
                <th> Net Flow </th>
			</tr>
			<?php
               	$q = esc_field($_GET['q']);
			    $rows = $database->get_results("SELECT * FROM tbl_jenis_tanaman ORDER BY net_flow DESC");
				$no=0;

				foreach($rows as $row):?>
                <tr>
    			   <td align='center'><?=++$no?></td>
    			   <td><?=$row->id_jenis_tanaman?></td>
    			   <td><?=$row->nama_tanaman?></td>
    			   <td><?=round($row->leaving_flow, 4)?></td>
     			   <td><?=round($row->entering_flow, 4)?></td>
    			   <td><?=round($row->net_flow, 4)?></td>
				</tr>
                <?php endforeach; ?>
		</table>
	</body>
</html>