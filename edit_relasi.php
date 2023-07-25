<?php
    $row = $database->get_row("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$_GET[ID]'"); 
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Form Edit Nilai Alternatif &raquo; <small><?=$row->nama_tanaman?></small></span>
		</div>
		<div id='main'>
			<form method="post" action="actions.php?act=edit_relasi&ID=<?=$row->id_jenis_tanaman?>">
				<?php
       				$rows = $database->get_results("SELECT ra.id_relasi, k.id_kriteria, k.nama_kriteria, ra.nilai FROM tbl_relasi ra INNER JOIN tbl_kriteria k ON k.id_kriteria=ra.id_kriteria WHERE id_jenis_tanaman='$_GET[ID]' ORDER BY id_kriteria");

        			foreach($rows as $row):?>
					<table>
						<tr>
							<td width="180px"><b> <?=$row->nama_kriteria?> </b></td>
							<td width="10px">:</td>
							<td><input type="text" class="sedang" name="ID-<?=$row->id_relasi?>" value="<?=$row->nilai?>" required /></td>
						</tr>
						<?php endforeach?>
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