<?php
	$rows = $database->get_results("SELECT a.id_jenis_tanaman, ra.id_kriteria, ra.nilai            
	        FROM tbl_relasi ra 
	        INNER JOIN tbl_jenis_tanaman a ON a.id_jenis_tanaman = ra.id_jenis_tanaman
	        WHERE nama_tanaman LIKE '%".esc_field($_GET['q'])."%'
	        ORDER BY ra.id_jenis_tanaman, ra.id_kriteria");
	$data = array();   
	
	foreach($rows as $row){
	    $data[$row->id_jenis_tanaman][$row->id_kriteria]  = $row->nilai;    
	}
?>

<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Data Nilai Alternatif </span>
		</div>
		<div id='main'>
			<form>
				<input type="hidden" name="m" value="relasi" />
            	<input type="hidden" name="page" value="<?=$_GET[page]?>" />
            	<input type="text" class="search" name="q" placeHolder="Search" width="141px" value="<?=$_GET['q']?>" required />
            	<button class="button">Search</button>
            	<a href="?m=relasi" class="button"> Refresh </a>
            	<a href="?m=relasi" class="button"> Kembali </a>
         	</form>
         	<br>
	        <table class="bordered">
	            <thead>
	               <tr>
	               	  <th width="10px"> No. </th>
	                  <th width="80px"> Id. Tanaman </th>
	                  <th> Nama Tanaman </th>
	                  <?php foreach($KRITERIA as $key => $val):?>
	                  <th> <?=$val['nama_kriteria']?> </th>
	                  <?php endforeach?>
	                  <th width="40px"> Aksi </th>
	               </tr>
	            </thead>
	            <tbody>
	            	<?php foreach($data as $key => $val):?>
	                  <tr>
	                  	 <td align='center'><?=++$no ?></td>
	                     <td><?=$ALTERNATIF[$key]['kode']?></td>
	                     <td><?=$ALTERNATIF[$key]['nama'];?></td>
	                     <?php foreach($val as $k => $v):?>
	                     <td><?=$v?></td>               
        				 <?php endforeach?>
	                     <td align='center'>
	                        <a class="btn" href="?m=edit_relasi&ID=<?=$key?>">
	                           <img src="images/edit.png" width="16" height="16" border="0">
	                        </a>
	                     </td>
	                  </tr>
	            	<?php endforeach;?>
	            </tbody>
	        </table>
		</div>
	</div>
</div>