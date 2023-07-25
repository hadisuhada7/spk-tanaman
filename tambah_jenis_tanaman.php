<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Input Jenis Tanaman </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=tambah_jenis_tanaman">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. Tanaman </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_jenis_tanaman" value="<?=set_value('id_jenis_tanaman', kode_otomatis('id_jenis_tanaman', 'tbl_jenis_tanaman', 'A', 1))?>" readonly required /></td>
						</tr>
						<tr>
							<td><b> Nama Tanaman </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_tanaman" placeHolder="e.g : Jangung" value="<?=set_value('nama_tanaman')?>" autofocus required /></td>
						</tr>
						<tr>
							<td><b> Keterangan </b></td>
							<td>:</td>
							<td><input type="text" class="panjang" name="keterangan" placeHolder="e.g : Kualitas Terbaik" value="<?=set_value('keterangan')?>" required /></td>						
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" class="button" value="Submit"/>
								<input type="reset" class="button" value="Cancel"/>
								<input type=button class=button value=Kembali onclick=self.history.back()>
							</td>
						</tr>
					</table>
			</form>
		</div>
	</div>
</div>