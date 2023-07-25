<div id='main-wrap'>
	<div id='main-center'>
		<div id='head-main'>
			<span> Data Perhitungan </span>
		</div>

		<?php
		    $c = $database->get_results("SELECT * FROM tbl_relasi WHERE nilai < 0");
		    if (!$ALTERNATIF || !$KRITERIA):
		        echo "Tampaknya anda belum mengatur Jenis Tanaman dan Kriteria. Silahkan tambahkan minimal 3 Jenis Tanaman dan 3 Kriteria.";
		    elseif ($c):
		        echo "Tampaknya anda belum mengatur Jenis Tanaman. Silahkan atur pada menu <strong> Jenis Tanaman </strong>.";
		    else:
		    
		    $data = get_data();
		    $komposisi = get_komposisi();
		    $normal = get_normal($data, $komposisi); 
		    $selisih = get_selisih($data, $normal);
		    $preferensi = get_preferensi($selisih);
		    $index_pref = get_index_pref($preferensi);
		    $total_index_pref = get_total_indeks_pref($index_pref);
		    $matriks = get_matriks($komposisi, $total_index_pref);
		    $total_kolom = get_total_kolom($matriks);
		    $total_baris = get_total_baris($matriks);
		    $leaving = get_leaving($matriks, $total_baris);
		    $entering = get_entering($matriks, $total_kolom);
		    $net_flow = get_net_flow($leaving, $entering);
		    $rank = get_rank($net_flow);
		?>

		<div id='main'>
	        <table class="bordered">
	            <thead>
	               <tr>
	                  <th colspan="15">Hasil Analisa</th>
	               </tr>
	               <tr>
	               	  <td rowspan="2"><b>Kriteria</b></td>
                	  <td rowspan="2"><b>Min / Max</b></td>
	                  <td rowspan="2"><b>Bobot</b></td>
	                  <td colspan="<?=count($ALTERNATIF)?>"><b>Alternatif</b></td>
	                  <td rowspan="2"><b>Tipe Pref</b></td>
	                  <td colspan="2"><b>Parameter</b></td>
	               </tr>
	               <tr>
                      <?php foreach($ALTERNATIF as $key => $val):?>
                	  <td><b><?=$val['nama']?></b></td>
                      <?php endforeach?>
                 	  <td><b>q</b></td>
                	  <td><b>p</b></td>
            	   </tr>
	            </thead>
	               <?php foreach($KRITERIA as $key => $val):?>
            	   <tr>
                      <td><?=$val['nama_kriteria']?></td>
                      <td><?=$val['kaidah_min_max']?></td>
                      <td><?=$val['bobot']?></td>
                      <?php foreach($ALTERNATIF as $k => $v):?>
                      <td><?=$data[$k][$key]?></td>
                      <?php endforeach?>
                      <td><?=$val['tipe_preferensi']?></td>
                      <td><?=$val['parameter_q']?></td>
                      <td><?=$val['parameter_p']?></td>
            	   </tr>
                   <?php endforeach?>
	        </table>
	        <br>
	        <?php foreach($normal as $key => $val):?>
	        <table class="bordered">
	            <thead>
	               <tr>
	                  <th colspan="8">Kriteria <?=$KRITERIA[$key]['nama_kriteria']?></th>
	               </tr>
	               <tr>
	               	  <td colspan="2"><b><?=$KRITERIA[$key]['nama_kriteria']?></b></td>
                	  <td><b>a</b></td>
	                  <td><b>b</b></td>
	                  <td><b>d (Jarak)</b></td>
	                  <td><b>|d|</b></td>
	                  <td><b>P (Preferensi)</b></td>
	                  <td><b>P (Indeks Preferensi)</b></td>
	               </tr>
	            </thead>
	               <?php foreach($val as $k => $v):?>
            	   <tr>
                      <td><?=$ALTERNATIF[$v[0]]['nama']?></td>
                      <td><?=$ALTERNATIF[$v[1]]['nama']?></td>
                      <td><?=$data[$v[0]][$key]?></td>
                      <td><?=$data[$v[1]][$key]?></td>
                      <td><?=$selisih[$key][$k]?></td>
                      <td><?=abs($selisih[$key][$k])?></td>
                      <td><?=$preferensi[$key][$k]?></td>
                      <td><?=$index_pref[$key][$k]?></td>
                   </tr>
                   <?php endforeach?>
	        </table>
	        <br>
	        <?php endforeach?>
	        <table class="bordered">
	            <thead>
	               <tr>
	                  <th colspan="8">Total Indeks Preferensi</th>
	               </tr>
	               <tr>
	               	  <td colspan="2"><b>Alternatif</b></td>
                	  <td><b>Total</b></td>
	               </tr>
	            </thead>
	               <?php foreach($komposisi as $key => $val):?>
            	   <tr>
                      <td><?=$ALTERNATIF[$val[0]]['nama']?></td>
                      <td><?=$ALTERNATIF[$val[1]]['nama']?></td>
                      <td><?=$total_index_pref[$key]?></td>
                   </tr>
                   <?php endforeach?>
	        </table>
	        <br>
	        <table class="bordered">
	            <thead>
	               <tr>
	                  <th colspan="12">Perbandingan Alternatif</th>
	               </tr>
	               <tr>
	               	  <td><b>Alternatif</b></td>
	               	  <?php foreach($matriks as $key => $val):?>
                	  <td><b><?=$ALTERNATIF[$key]['nama']?></b></td>
                	  <?php endforeach?>
                	  <td><b>Jumlah</b></td>
                	  <td><b>Leaving</b></td>
	               </tr>
	            </thead>
	               <?php foreach($matriks as $key => $val):?>
                   <tr>
                      <td><?=$ALTERNATIF[$key]['nama']?></td>
                      <?php foreach($val as $k => $v):?>
                      <td><?=round($v, 4)?></td>
                      <?php endforeach?>    
                      <td><?=round($total_baris[$key], 4)?></td>
                      <td><?=round($leaving[$key], 4)?></td>
                   </tr>        
                   <?php endforeach?>
                   <tr>
                      <td><b>Jumlah</b></td>
                      <?php foreach($total_kolom as $k => $v):?>
                      <td><?=round($v, 4)?></td>
                      <?php endforeach?>
                      <td></td>
                      <td></td>
                   </tr>
                   <tr>
                      <td><b>Entering</b></td>
                      <?php foreach($entering as $k => $v):?>
                      <td><?=round($v, 4)?></td>
                      <?php endforeach?>
                      <td></td>
                      <td></td>
                   </tr>
	        </table>
	        <br>
	        <table class="bordered">
	            <thead>
	               <tr>
	                  <th colspan="8">Hasil Akhir</th>
	               </tr>
	               <tr>
	               	  <td><b>Alternatif</b></td>
                	  <td><b>Leaving Flow</b></td>
                	  <td><b>Entering Flow</b></td>
                	  <td><b>Net Flow</b></td>
                	  <td><b>Rangking</b></td>
	               </tr>
	            </thead>
	               <?php 
            			//print_r($net_flow);
			            foreach($rank as $key => $val):
			            $database->query("UPDATE tbl_jenis_tanaman set leaving_flow='$leaving[$key]', entering_flow='$entering[$key]', net_flow='$net_flow[$key]' WHERE id_jenis_tanaman='$key'");
            	   ?>
            	   <tr>
                      <td><?=$ALTERNATIF[$key]['nama']?></td>            
                      <td><?=round($leaving[$key], 4)?></td>
                      <td><?=round($entering[$key], 4)?></td>
                      <td><?=round($net_flow[$key], 4)?></td>
                      <td><b><?=$rank[$key]?><b></td>
                   </tr> 
                   <?php endforeach?>
	        </table>
	        
	        <?php
				arsort($net_flow);
			?>
			
			<p align="center">
	    		Hasil perhitungan menunjukkan bahwa <b> Jenis Tanaman </b> terbaik adalah <strong><?=$ALTERNATIF[key($net_flow)]['nama']?></strong> dengan <b> Net Flow </b> : <strong><?=round(current($net_flow), 4)?></strong>
	    	</p>
	    	<p align="center">
	    		<input type="button" class="button" value="Print" onclick="print_d()"/>
	    		<input type="button" class="button" value="Export Excel" onclick="export_e()"/>
			</p>
			<script>
				function print_d(){
					window.open("print_hitung.php","_blank");
				}
				function export_e(){
					window.open("export_hitung.php","_blank");
				}
			</script>

			<?php endif?>

		</div>
	</div>
</div>