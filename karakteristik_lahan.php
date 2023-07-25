<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Data Karakteristik Lahan </span>
		</div>
		<div id='main'>
			<form>
				<input type="hidden" name="m" value="karakteristik_lahan" />
            	<input type="hidden" name="page" value="<?=$_GET[page]?>" />
            	<input type="text" class="search" name="q" placeHolder="Search" width="141px" value="<?=$_GET['q']?>" required />
            	<button class="button">Search</button>
            	<a href="?m=tambah_karakteristik_lahan" class="button"> Tambah </a>
            	<a href="?m=karakteristik_lahan" class="button"> Kembali </a>
         	</form>
         	<br>
	        <table class="bordered">
	            <thead>
	               <tr>
	               	  <th width="10px"> No. </th>
	                  <th width="80px"> Id. Lahan </th>
	                  <th> Nama Lokasi </th>
	                  <th> Ketinggian </th>
	                  <th> Temperatur </th>
	                  <th> Curah Hujan </th>
	                  <th> Lama Penyinaran </th>
	                  <th> Kelembaban </th>
	                  <th width="123px"> Aksi </th>
	               </tr>
	            </thead>
	            <?php
           			$q = esc_field($_GET['q']);   
                            
    				$rows = $database->get_results("SELECT * FROM tbl_karakteristik_lahan WHERE id_karakteristik_lahan LIKE '%$q%' OR nama_lokasi LIKE '%$q%' OR ketinggian LIKE '%$q%' OR temperatur_udara LIKE '%$q%' OR curah_hujan LIKE '%$q%' OR lama_penyinaran LIKE '%$q%' OR kelembaban_udara LIKE '%$q%'");                
            		$no = 0;
                    
            		foreach($rows as $row):?>
	                  <tr>
	                  	 <td align='center'><?=++$no ?></td>
	                     <td><?=$row->id_karakteristik_lahan?></td>
	                     <td><?=$row->nama_lokasi?></td>
	                     <td><?=$row->ketinggian?></td>
	                     <td><?=$row->temperatur_udara?></td>
	                     <td><?=$row->curah_hujan?></td>
	                     <td><?=$row->lama_penyinaran?></td>
	                     <td><?=$row->kelembaban_udara?></td>
	                     <td align='center'>
	                        <a class="btn" href="?m=detail_karakteristik_lahan&ID=<?=$row->id_karakteristik_lahan?>">
	                           <img src="images/view.png" width="16" height="16" border="0"> 
	                        </a>
	                        <a class="btn" href="?m=edit_karakteristik_lahan&ID=<?=$row->id_karakteristik_lahan?>">
	                           <img src="images/edit.png" width="16" height="16" border="0">
	                        </a>
	                        <a class="btn" href="actions.php?act=delete_karakteristik_lahan&ID=<?=$row->id_karakteristik_lahan?>" onclick="return confirm('Yakin Menghapus Data ?')">
	                           <img src="images/delete.png" width="16" height="16" border="0">
	                        </a>
	                     </td>
	                  </tr>
	            <?php endforeach;?>
	        </table>
		</div>
	</div>
</div>