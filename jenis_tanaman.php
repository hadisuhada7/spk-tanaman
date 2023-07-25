<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Data Jenis Tanaman </span>
		</div>
		<div id='main'>
			<form>
				<input type="hidden" name="m" value="jenis_tanaman" />
            	<input type="hidden" name="page" value="<?=$_GET[page]?>" />
            	<input type="text" class="search" name="q" placeHolder="Search" width="141px" value="<?=$_GET['q']?>" required />
            	<button class="button">Search</button>
            	<a href="?m=tambah_jenis_tanaman" class="button"> Tambah </a>
            	<a href="?m=jenis_tanaman" class="button"> Kembali </a>
         	</form>
         	<br>
	        <table class="bordered">
	            <thead>
	               <tr>
	               	  <th width="10px"> No. </th>
	                  <th width="80px"> Id. Tanaman </th>
	                  <th> Nama </th>
	                  <th> Keterangan </th>
	                  <th width="123px"> Aksi </th>
	               </tr>
	            </thead>
	            <?php
           			$q = esc_field($_GET['q']);   
                            
    				$rows = $database->get_results("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman LIKE '%$q%' OR nama_tanaman LIKE '%$q%' OR keterangan LIKE '%$q%'");                
            		$no = 0;
                    
            		foreach($rows as $row):?>
	                  <tr>
	                  	 <td align='center'><?=++$no ?></td>
	                     <td><?=$row->id_jenis_tanaman?></td>
	                     <td><?=$row->nama_tanaman?></td>
	                     <td><?=$row->keterangan?></td>
	                     <td align='center'>
	                        <a class="btn" href="?m=detail_jenis_tanaman&ID=<?=$row->id_jenis_tanaman?>">
	                           <img src="images/view.png" width="16" height="16" border="0"> 
	                        </a>
	                        <a class="btn" href="?m=edit_jenis_tanaman&ID=<?=$row->id_jenis_tanaman?>">
	                           <img src="images/edit.png" width="16" height="16" border="0">
	                        </a>
	                        <a class="btn" href="actions.php?act=delete_jenis_tanaman&ID=<?=$row->id_jenis_tanaman?>" onclick="return confirm('Yakin Menghapus Data ?')">
	                           <img src="images/delete.png" width="16" height="16" border="0">
	                        </a>
	                     </td>
	                  </tr>
	            <?php endforeach;?>
	        </table>
		</div>
	</div>
</div>