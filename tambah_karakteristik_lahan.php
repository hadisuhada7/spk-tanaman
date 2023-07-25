<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Input Karakteristik Lahan </span>
		</div>
		<div id='main'>
			<form method="post" action="?m=tambah_karakteristik_lahan">
				<?php 
					if($_POST) include'actions.php'
				?>
					<table>
						<tr>
							<td width="180px"><b> Id. Karakteristik Lahan </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="kecil" name="id_karakteristik_lahan" value="<?=set_value('id_karakteristik_lahan', kode_otomatis('id_karakteristik_lahan', 'tbl_karakteristik_lahan', 'K', 1))?>" readonly required /></td>
						</tr>
						<td colspan="3" align="center"><hr><b> Lokasi Lahan</b><hr></td>
						<tr>
							<td><b> Nama Lokasi </b></td>
							<td>:</td>
							<td><input type="text" class="sedang" name="nama_lokasi" placeHolder="e.g : Kota Cirebon" value="<?=set_value('nama_lokasi')?>" required /></td>
						</tr>
						<td colspan="3" align="center"><hr><b> Karakteristik Lahan </b><hr></td>
						<tr>
							<td><b> Ketinggian </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="ketinggian" placeHolder="e.g : 200" value="<?=set_value('ketinggian')?>" required /><i> mdpl </i></td>
						</tr>
						<tr>
							<td><b> Temperatur Udara </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="temperatur_udara" placeHolder="e.g : 20-40" value="<?=set_value('temperatur_udara')?>" required /> &deg;C </td>		
						</tr>
						<tr>
							<td><b> Curah Hujan </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="curah_hujan" placeHolder="e.g : 2260" value="<?=set_value('curah_hujan')?>" required /><i> mm </i> / tahun </td>		
						</tr>
						<tr>
							<td><b> Lama Penyinaran </b></td>
							<td>:</td>
							<td> <select name="lama_penyinaran">
									<?=get_lama_penyinaran_option(set_value('lama_penyinaran'))?>
								 </select>
								 bulan
							</td>
						</tr>
						<tr>
							<td><b> Kelembaban Udara </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="kelembaban_udara" placeHolder="e.g : 1-100" value="<?=set_value('kelembaban_udara')?>" required /> % </td>		
						</tr>
						<tr>
							<td><b> Drainase </b></td>
							<td>:</td>
							<td> <select name="drainase">
									<?=get_drainase_option(set_value('drainase'))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Tekstur Tanah </b></td>
							<td>:</td>
							<td> <select name="tekstur_tanah">
									<?=get_tekstur_tanah_option(set_value('tekstur_tanah'))?>
								 </select>
							</td>
						</tr>
						<tr>
							<td><b> Reaksi Tanah (pH) </b></td>
							<td>:</td>
							<td><input type="text" class="kecil" name="reaksi_tanah" placeHolder="e.g : 4-10" value="<?=set_value('reaksi_tanah')?>" required /></td>		
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