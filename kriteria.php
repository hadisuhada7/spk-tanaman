<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Data Kriteria </span>
		</div>
		<div id='main'>
			<form>
				<input type="hidden" name="m" value="kriteria" />
            	<input type="hidden" name="page" value="<?=$_GET[page]?>" />
            	<input type="text" class="search" name="q" placeHolder="Search" width="141px" value="<?=$_GET['q']?>" required />
            	<button class="button">Search</button>
            	<a href="?m=tambah_kriteria" class="button"> Tambah </a>
            	<a href="?m=kriteria" class="button"> Kembali </a>
         	</form>
         	<br>
	        <table class="bordered">
	            <thead>
	               <tr>
	               	  <th width="10px"> No. </th>
	                  <th width="75px"> Id. Kriteria </th>
	                  <th> Nama </th>
	                  <th> Bobot </th>
	                  <th> Min / Max </th>
	                  <th> Tipe Preferensi </th>
	                  <th> Q </th>
	                  <th> P </th>
	                  <th width="123px"> Aksi </th>
	               </tr>
	            </thead>
	            <?php
           			$q = esc_field($_GET['q']);   
                            
    				$rows = $database->get_results("SELECT * FROM tbl_kriteria WHERE id_kriteria LIKE '%$q%' OR nama_kriteria LIKE '%$q%' OR bobot LIKE '%$q%' OR kaidah_min_max LIKE '%$q%' OR tipe_preferensi LIKE '%$q%' OR parameter_q LIKE '%$q%' OR parameter_p LIKE '%$q%'");                
            		$no = 0;
                    
            		foreach($rows as $row):?>
	                  <tr>
	                  	 <td align='center'><?=++$no ?></td>
	                     <td><?=$row->id_kriteria?></td>
	                     <td><?=$row->nama_kriteria?></td>
	                     <td><?=$row->bobot?></td>
	                     <td><?=$row->kaidah_min_max?></td>
	                     <td><?=$row->tipe_preferensi?></td>
	                     <td><?=$row->parameter_q?></td>
	                     <td><?=$row->parameter_p?></td>
	                     <td align='center'>
	                        <a class="btn" href="?m=detail_kriteria&ID=<?=$row->id_kriteria?>">
	                           <img src="images/view.png" width="16" height="16" border="0"> 
	                        </a>
	                        <a class="btn" href="?m=edit_kriteria&ID=<?=$row->id_kriteria?>">
	                           <img src="images/edit.png" width="16" height="16" border="0">
	                        </a>
	                        <a class="btn" href="actions.php?act=delete_kriteria&ID=<?=$row->id_kriteria?>" onclick="return confirm('Yakin Menghapus Data ?')">
	                           <img src="images/delete.png" width="16" height="16" border="0">
	                        </a>
	                     </td>
	                  </tr>
	            <?php endforeach;?>
	        </table>
		</div>
	</div>
</div>