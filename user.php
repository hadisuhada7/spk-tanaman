<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Manajemen User </span>
		</div>
		<div id='main'>
			<form>
				<input type="hidden" name="m" value="user" />
            	<input type="hidden" name="page" value="<?=$_GET[page]?>" />
            	<input type="text" class="search" name="q" placeHolder="Search" width="141px" value="<?=$_GET['q']?>" required />
            	<button class="button">Search</button>
            	<a href="?m=tambah_user" class="button"> Tambah </a>
            	<a href="?m=user" class="button"> Kembali </a>
         	</form>
         	<br>
	        <table class="bordered">
	            <thead>
	               <tr>
	               	  <th width="10px"> No. </th>
	                  <th width="50px"> Id. User </th>
	                  <th> Nama Lengkap </th>
	                  <th> Jenis Kelamin </th>
	                  <th> Usermane </th>
	                  <th> Level </th>
	                  <th width="123px"> Aksi </th>
	               </tr>
	            </thead>
	            <?php
           			$q = esc_field($_GET['q']);   
                            
    				$rows = $database->get_results("SELECT * FROM tbl_user WHERE id_user LIKE '%$q%' OR nama_lengkap LIKE '%$q%' OR jenis_kelamin LIKE '%$q%' OR username LIKE '%$q%' OR level LIKE '%$q%'");                
            		$no = 0;
                    
            		foreach($rows as $row):?>
	                  <tr>
	                  	 <td align='center'><?=++$no ?></td>
	                     <td><?=$row->id_user?></td>
	                     <td><?=$row->nama_lengkap?></td>
	                     <td><?=$row->jenis_kelamin?></td>
	                     <td><?=$row->username?></td>
	                     <td><?=$row->level?></td>
	                     <td align='center'>
	                        <a class="btn" href="?m=detail_user&ID=<?=$row->id_user?>">
	                           <img src="images/view.png" width="16" height="16" border="0"> 
	                        </a>
	                        <a class="btn" href="?m=edit_user&ID=<?=$row->id_user?>">
	                           <img src="images/edit.png" width="16" height="16" border="0">
	                        </a>
	                        <a class="btn" href="actions.php?act=delete_user&ID=<?=$row->id_user?>" onclick="return confirm('Yakin Menghapus Data ?')">
	                           <img src="images/delete.png" width="16" height="16" border="0">
	                        </a>
	                     </td>
	                  </tr>
	            <?php endforeach ;?>
	        </table>
		</div>
	</div>
</div>