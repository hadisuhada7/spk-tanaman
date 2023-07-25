<?php
    $row = $database->get_row("SELECT * FROM tbl_karakteristik_lahan WHERE id_karakteristik_lahan='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Rincian Data Karakteristik Lahan </span>
		</div>
		<div id='main'>
			<table>
				<tr>
					<td width="180px"><b> Id. Karakteristik Lahan </b></td>
					<td width="10px">:</td>
					<td> <?php echo $row->id_karakteristik_lahan;?> </td>
				</tr>
				<tr>
					<td><b> Nama Lokasi </b></td>
					<td>:</td>
					<td> <?php echo $row->nama_lokasi;?> </td>
				</tr>
				<tr>
					<td><b> Ketinggian </b></td>
					<td>:</td>
					<td> <?php echo $row->ketinggian;?> <i> mdpl </i></td>
				</tr>
				<tr>
					<td><b> Temperatur Udara </b></td>
					<td>:</td>
					<td> <?php echo $row->temperatur_udara;?> &deg;C </td>
				</tr>
				<tr>
					<td><b> Curah Hujan </b></td>
					<td>:</td>
					<td> <?php echo $row->curah_hujan;?> <i> mm </i> / tahun </td>
				</tr>
				<tr>
					<td><b> Lama Penyinaran </b></td>
					<td>:</td>
					<td> <?php echo $row->lama_penyinaran;?> bulan </td>
				</tr>
				<tr>
					<td><b> Kelembaban Udara </b></td>
					<td>:</td>
					<td> <?php echo $row->kelembaban_udara;?> % </td>
				</tr>
				<tr>
					<td><b> Drainase </b></td>
					<td>:</td>
					<td> <?php echo $row->drainase;?> </td>
				</tr>
				<tr>
					<td><b> Tekstur Tanah </b></td>
					<td>:</td>
					<td> <?php echo $row->tekstur_tanah;?> </td>
				</tr>
				<tr>
					<td><b> Reaksi Tanah (pH) </b></td>
					<td>:</td>
					<td> <?php echo $row->reaksi_tanah;?> </td>
				</tr>
			</table>
			<br>
         	<center><input type=button class=button value=Kembali onclick=self.history.back()></center>
		</div>
	</div>
</div>