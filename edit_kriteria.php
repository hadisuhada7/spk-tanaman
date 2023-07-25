<?php
    $row = $database->get_row("SELECT * FROM tbl_kriteria WHERE id_kriteria='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Edit Kriteria </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=edit_kriteria&ID=<?=$row->id_kriteria?>">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. Kriteria </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_kriteria" value="<?=set_value('id_kriteria', $row->id_kriteria)?>" readonly required /></td>
						</tr>
						<tr>
							<td><b> Nama Kriteria </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_kriteria" placeHolder="e.g : Ketinggian" value="<?=set_value($_POST['nama_kriteria'], $row->nama_kriteria)?>" autofocus required /></td>
						</tr>
						<tr>
							<td><b> Bobot </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="bobot" placeHolder="e.g : 1-100" value="<?=set_value($_POST['bobot'], $row->bobot)?>" required /> % </td>
						</tr>
						<tr>
							<td><b> Kaidah Min / Max </b></td>
							<td>:</td>
							<td> <select name="kaidah_min_max">
									<?=get_kaidah_min_max_option(set_value('kaidah_min_max', $row->kaidah_min_max))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Tipe Preferensi </b></td>
							<td>:</td>
							<td> <select name="tipe_preferensi">
									<?=get_tipe_preferensi_option(set_value('tipe_preferensi', $row->tipe_preferensi))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Parameter Q </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="parameter_q" placeHolder="e.g : 100" value="<?=set_value($_POST['parameter_q'], $row->parameter_q)?>" required /></td>
						</tr>
						<tr>
							<td><b> Parameter P </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="parameter_p" placeHolder="e.g : 100" value="<?=set_value($_POST['parameter_p'], $row->parameter_p)?>" required /></td>
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