<?php
    $row = $database->get_row("SELECT * FROM tbl_user WHERE id_user='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Edit User </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=edit_user&ID=<?=$row->id_user?>">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. User </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_user" value="<?=set_value('id_user', $row->id_user)?>" readonly required /></td>
						</tr>
						<tr>
							<td><b> Nama Lengkap </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_lengkap" placeHolder="e.g : Hadi Suhada" value="<?=set_value($_POST['nama_lengkap'], $row->nama_lengkap)?>" autofocus required /></td>
						</tr>
						<tr>
							<td><b> Username </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="username" placeHolder="e.g : hadisuhada7@gmail.com" value="<?=set_value($_POST['username'], $row->username)?>" required /></td>
						</tr>
						<tr>
							<td><b> Password </b></td>
							<td>:</td>
							<td><input type="password" class="sedang" name="password" placeHolder="Type Password" value="" required /></td>
						</tr>
						<tr>
							<td><b> Tempat Lahir </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="tempat_lahir" placeHolder="e.g : Kota Cirebon" value="<?=set_value($_POST['tempat_lahir'], $row->tempat_lahir)?>" required /></td>
						</tr>
						<tr>
							<td><b> Tanggal Lahir </b></td>
							<td>:</td>
							<td><input type="date" name="tgl_lahir" value="<?=set_value($_POST['tgl_lahir'], $row->tgl_lahir)?>" required /></td>
						</tr>
						<tr>
							<td><b> Jenis Kelamin </b></td>
							<td>:</td>
							<td>
								<input type="radio" name="jenis_kelamin" value="Laki-Laki" required /> Laki-Laki
								<input type="radio" name="jenis_kelamin" value="Perempuan" required /> Perempuan 
							</td>
						</tr>
						<tr>
							<td><b> No. Telepon </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="no_telepon" placeHolder="e.g : 081903840500" value="<?=set_value($_POST['no_telepon'], $row->no_telepon)?>" required /></td>
						</tr>
						<tr>
							<td><b> Level </b></td>
							<td>:</td>
							<td> <select name="level">
									<?=get_level_option(set_value('level', $row->level))?>
								 </select>
							</td>
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