<?php
    $row = $database->get_row("SELECT * FROM tbl_user WHERE id_user='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Rincian Data User </span>
		</div>
		<div id='main'>
			<table>
				<tr>
					<td width="180px"><b> Id. User </b></td>
					<td width="10px">:</td>
					<td> <?php echo $row->id_user;?> </td>
				</tr>
				<tr>
					<td><b> Nama Lengkap </b></td>
					<td>:</td>
					<td> <?php echo $row->nama_lengkap;?> </td>
				</tr>
				<tr>
					<td><b> Username </b></td>
					<td>:</td>
					<td> <?php echo $row->username;?> </td>
				</tr>
				<tr>
					<td><b> Tempat Lahir </b></td>
					<td>:</td>
					<td> <?php echo $row->tempat_lahir;?> </td>
				</tr>
				<tr>
					<td><b> Tanggal Lahir </b></td>
					<td>:</td>
					<td> <?php echo $row->tgl_lahir;?> </td>
				</tr>
				<tr>
					<td><b> Jenis Kelamin </b></td>
					<td>:</td>
					<td> <?php echo $row->jenis_kelamin;?> </td>
				</tr>
				<tr>
					<td><b> No. Telepon </b></td>
					<td>:</td>
					<td> <?php echo $row->no_telepon;?> </td>
				</tr>
				<tr>
					<td><b> Level </b></td>
					<td>:</td>
					<td> <?php echo $row->level;?> </td>
				</tr>
			</table>
			<br>
         	<center><input type=button class=button value=Kembali onclick=self.history.back()></center>
		</div>
	</div>
</div>