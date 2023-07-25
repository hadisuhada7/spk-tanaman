<?php
    $row = $database->get_row("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Edit Jenis Tanaman </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=edit_jenis_tanaman&ID=<?=$row->id_jenis_tanaman?>">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. Tanaman </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_jenis_tanaman" value="<?=set_value('id_jenis_tanaman', $row->id_jenis_tanaman)?>" readonly required /></td>
						</tr>
						<tr>
							<td><b> Nama Tanaman </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_tanaman" placeHolder="e.g : Jagung" value="<?=set_value($_POST['nama_tanaman'], $row->nama_tanaman)?>" autofocus required /></td>
						</tr>
						<tr>
							<td><b> Keterangan </b></td>
							<td>:</td>
							<td><input type="text" class="panjang" name="keterangan" placeHolder="e.g : Kualitas Terbaik" value="<?=set_value($_POST['keterangan'], $row->keterangan)?>" required /></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" class="button" value="Update"/>
								<input type="reset" class="button" value="Cancel"/>
								<input type=button class=button value=Kembali onclick=self.history.back()>
							</td>
						</tr>
					</table>
			</form>
		</div>
	</div>
</div>