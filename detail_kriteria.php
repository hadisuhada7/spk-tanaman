<?php
    $row = $database->get_row("SELECT * FROM tbl_kriteria WHERE id_kriteria='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Rincian Data Kriteria </span>
		</div>
		<div id='main'>
			<table>
				<tr>
					<td width="180px"><b> Id. Kriteria </b></td>
					<td width="10px">:</td>
					<td> <?php echo $row->id_kriteria;?> </td>
				</tr>
				<tr>
					<td><b> Nama Kriteria </b></td>
					<td>:</td>
					<td> <?php echo $row->nama_kriteria;?> </td>
				</tr>
				<tr>
					<td><b> Bobot </b></td>
					<td>:</td>
					<td> <?php echo $row->bobot;?> % </td>
				</tr>
				<tr>
					<td><b> Kaidah Min / Max </b></td>
					<td>:</td>
					<td> <?php echo $row->kaidah_min_max;?> </td>
				</tr>
				<tr>
					<td><b> Tipe Preferensi </b></td>
					<td>:</td>
					<td> <?php echo $row->tipe_preferensi;?> </td>
				</tr>
				<tr>
					<td><b> Parameter Q </b></td>
					<td>:</td>
					<td> <?php echo $row->parameter_q;?> </td>
				</tr>
				<tr>
					<td><b> Parameter P </b></td>
					<td>:</td>
					<td> <?php echo $row->parameter_p;?> </td>
				</tr>
			</table>
			<br>
         	<center><input type=button class=button value=Kembali onclick=self.history.back()></center>
		</div>
	</div>
</div>