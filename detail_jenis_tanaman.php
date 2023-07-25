<?php
    $row = $database->get_row("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Rincian Data Jenis Tanaman </span>
		</div>
		<div id='main'>
			<table>
				<tr>
					<td width="180px"><b> Id. Tanaman </b></td>
					<td width="10px">:</td>
					<td> <?php echo $row->id_jenis_tanaman;?> </td>
				</tr>
				<tr>
					<td><b> Nama Tanaman </b></td>
					<td>:</td>
					<td> <?php echo $row->nama_tanaman;?> </td>
				</tr>
				<tr>
					<td><b> Keterangan </b></td>
					<td>:</td>
					<td> <?php echo $row->keterangan;?> </td>
				</tr>
			</table>
			<br>
         	<center><input type=button class=button value=Kembali onclick=self.history.back()></center>
		</div>
	</div>
</div>