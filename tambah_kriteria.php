<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Input Kriteria </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=tambah_kriteria">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. Kriteria </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_kriteria" value="<?=set_value('id_kriteria', kode_otomatis('id_kriteria', 'tbl_kriteria', 'F', 1))?>" readonly required /></td>
						</tr>
						<tr>
							<td><b> Nama Kriteria </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_kriteria" placeHolder="e.g : Ketinggian" value="<?=set_value('nama_kriteria')?>" autofocus required /></td>
						</tr>
						<tr>
							<td><b> Bobot </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="bobot" placeHolder="e.g : 1-100" value="<?=set_value('bobot')?>" required /> % </td>						
						</tr>
						<tr>
							<td><b> Kaidah Min / Max </b></td>
							<td>:</td>
							<td> <select name="kaidah_min_max">
									<?=get_kaidah_min_max_option(set_value('kaidah_min_max'))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Tipe Preferensi </b></td>
							<td>:</td>
							<td> <select name="tipe_preferensi">
									<?=get_tipe_preferensi_option(set_value('tipe_preferensi'))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Parameter Q </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="parameter_q" placeHolder="e.g : 100" value="<?=set_value('parameter_q')?>" required /></td>
						</tr>
						<tr>
							<td><b> Parameter P </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="parameter_p" placeHolder="e.g : 100" value="<?=set_value('parameter_p')?>" required /></td>
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