<?php
	
	// Menyembunyikan error notice
	error_reporting(~E_NOTICE); 
	
	// Start session untuk login
	session_start();

	include 'config.php';
	include 'includes/database.php';
	
	// Koneksi ke database
	$database = new database($config['server'], $config['username'], $config['password'], $config['database_name']);
	include'includes/general.php';

	// Menyimpan variabel m dan act dari url
	$mod = $_GET['m'];
	$act = $_GET['act'];

	// Menyimpan data jenis tanaman ke array
	$rows = $database->get_results("SELECT id_jenis_tanaman, nama_tanaman FROM tbl_jenis_tanaman ORDER BY id_jenis_tanaman");
	foreach($rows as $row){
	    $ALTERNATIF[$row->id_jenis_tanaman]['kode'] = $row->id_jenis_tanaman;
	    $ALTERNATIF[$row->id_jenis_tanaman]['nama'] = $row->nama_tanaman;
	}

	// Menyimpan data kriteria ke array
	$rows = $database->get_results("SELECT id_kriteria, nama_kriteria, bobot, kaidah_min_max, tipe_preferensi, parameter_q, parameter_p FROM tbl_kriteria ORDER BY id_kriteria");
	foreach($rows as $row){
	    $KRITERIA[$row->id_kriteria] = array(
	        'nama_kriteria'=>$row->nama_kriteria,
	        'bobot'=>$row->bobot,
	        'kaidah_min_max'=>$row->kaidah_min_max,
	        'tipe_preferensi'=>$row->tipe_preferensi,
	        'parameter_p'=>$row->parameter_p,
	        'parameter_q'=>$row->parameter_q,
	    );
	}

	// Mengatur hak akses dari admin dan user
	function is_able($mod){
	    $role = array(
	        'Admin' => array(
	            'beranda',
	            'kriteria',
	            'jenis_tanaman',  
	            'karakteristik_lahan', 
	            'relasi',   
	            'hitung',
	            'user',  
	        ),
	        'User' => array(
	            'beranda',
	            'kriteria',
	            'jenis_tanaman',  
	            'karakteristik_lahan', 
	            'relasi',   
	            'hitung',  
	        ),
	    );    
	    
	    return in_array($mod, (array)$role[$_SESSION['level']]);        
	}
	
	// Jika tidak mempunyai akses maka dihidden
	function is_hidden($mod){    
	    return (is_able($mod)) ? '' : 'hidden';        
	}
	
	// HTML select untuk level login
	function get_level_option($selected = ''){
	    global $database;
	    $arr = array(
	        'Admin' => 'Admin',
	        'User' => 'User',   
	    );
	    foreach($arr as $key => $val){
	        if($key==$selected)
	            $a.="<option value='$key' selected>$val</option>";
	        else
	            $a.="<option value='$key'>$val</option>";
	    }
	    return $a;
	}

	// Mencari komposisi dari data alternatif
	function get_komposisi(){
	    global $ALTERNATIF;
	    $arr = array();
	    $keys = array_keys($ALTERNATIF);
	    
	    foreach($keys as $key){
	        foreach($keys as $k){
	            if($key!=$k)
	                $arr[$key][$k] = 1;
	        }
	    }    
	    
	    $result = array();
	    foreach($arr as $key => $val){
	        foreach($val as $k => $v){
	            $result[] = array($key, $k);
	        }
	    }
	            
	    return $result;
	}

	// Mencari komposisi untuk semua kriteria
	function get_normal($data = array(), $komposisi = array()){
	    // Membuat variabel array untuk menyimpan hasil
	    $arr = array();    
	    // Setting variabel kriteria biar bisa diakses di fungsi ini
	    global $KRITERIA;    
	    // Diulang sebanyak elemen pada kriteria ($key ada kunci atau index array, $val adalah isi array)
	    foreach($KRITERIA as $key => $val){
	        // Diulang sebanyak elemen pada komposisi ($k ada kunci atau index array, $v adalah isi array)
	        foreach($komposisi as $k => $v){
	            // Menaruh isi komposisi ke variabel $arr
	            $arr[$key][] = array( $v[0], $v[1]);
	        }
	    }
	    // Mengembalikan nilai $arr
	    return $arr;
	}

	// Mencari selisih nilai a dan b
	function get_selisih($data = array(), $normal = array()){
	    $arr = array();
	    
	    foreach($normal as $key => $val){
	        foreach($val as $k => $v){
	            $arr[$key][$k] = $data[$v[0]][$key] - $data[$v[1]][$key];
	        }
	    }
	    return $arr;
	}

	// Mencari nilai preferensi
	function get_preferensi($selisih = array()){
	    global $KRITERIA;
	    foreach($selisih as $key => $val){
	        foreach($val as $k => $v){
	            $arr[$key][$k] = hitung_pref($KRITERIA[$key]['tipe_preferensi'], $KRITERIA[$key]['parameter_q'], $KRITERIA[$key]['parameter_p'], $KRITERIA[$key]['kaidah_min_max'], $v);
	        }
	    }
	    return $arr;
	}

	// Mencari indeks preferensi
	function get_index_pref($preferensi = array()){
	    global $KRITERIA;
	    $arr = array();
	    foreach($preferensi as $key => $val){
	        foreach($val as $k => $v){        
	            $arr[$key][$k] = $v * $KRITERIA[$key]['bobot'];
	        }
	    }    
	    return $arr;
	}

	// Menghitung preferensi berdasarkan tipe preferensi pada masing-masing kriteria
	function hitung_pref($tipe_preferensi, $parameter_q, $parameter_p, $kaidah_min_max, $jarak){
	    $kaidah_min_max = strtolower($kaidah_min_max);
	    if($kaidah_min_max=='minimal' && $jarak > 0)
	        return 0;
	    if($kaidah_min_max=='maksimal' && $jarak < 0)
	        return 0;
	    if($tipe_preferensi==5){
	        if(abs($jarak) <= $parameter_q)
	            return 0;
	        if(abs($jarak) > $parameter_q && abs($jarak) <= $parameter_p)
	            return (abs($jarak) - $parameter_q) / ($parameter_p - $parameter_q);
	        if($parameter_p < abs($jarak))
	            return 1;
	        return -1;
	    } else if($tipe_preferensi==4){
	        if(abs($jarak) <= $parameter_q)
	            return 0;
	        if(abs($jarak) > $parameter_q && abs($jarak) <= $parameter_p)
	            return 0.5;
	        if($parameter_p < abs($jarak))
	            return 1;
	        return -1;
	    } else if($tipe_preferensi==3){
	        if($jarak >= $parameter_p * -1 && $jarak <= $parameter_p)
	            return $jarak / $parameter_p;
	        if($jarak < $parameter_p * -1 || $jarak >= $parameter_p)
	            return 1;
	        return -1;
	    } else if($tipe_preferensi==2){
	        if($jarak >= $parameter_q * -1 && $jarak <= $parameter_q)
	            return 0;
	        if($jarak < $parameter_q * -1 || $jarak >= $parameter_q)
	            return 1;
	        return -1;
	    } else if($tipe_preferensi==1){
	        if($jarak == 0)
	            return 0;
	        elseif($jarak != 0)
	            return 1;  
	        return -1;                  
	    } else {
	        return -1;
	    } 
	}

	// Mencari total indeks preferensi
	function get_total_indeks_pref($index_pref = array()){
	    $arr = array();
	    foreach($index_pref as $key => $val){
	        foreach($val as $k => $v){
	            $arr[$k]+= $v;
	        }
	    }
	    return $arr;
	}

	// Mencari matriks berdasarkan komposisi dan total index preferensi
	function get_matriks($komposisi = array(), $total_index_pref = array()){
	    $arr = array();
	    global $ALTERNATIF;
	    foreach($ALTERNATIF as $key => $val){
	        foreach($ALTERNATIF as $k => $v){
	            $arr[$key][$k] = 0;
	        }
	    }
	    
	    foreach($komposisi as $key => $val){
	        $arr[$val[0]][$val[1]] = $total_index_pref[$key];
	    }
	    return $arr;
	}
	
	// Mencari total kolom dari matriks
	function get_total_kolom($matriks = array()){
	    $arr = array();
	    foreach($matriks as $key => $val){
	        foreach($val as $k => $v){
	            $arr[$k]+=$v;
	        }
	    }
	    return $arr; 
	}

	// Mencari total baris dari matriks
	function get_total_baris($matriks = array()){
	    $arr = array();
	    foreach($matriks as $key => $val){
	        foreach($val as $k => $v){
	            $arr[$key]+=$v;
	        }
	    }
	    return $arr;
	}

	// Mencari nilai leaving
	function get_leaving($matriks = array(), $total_baris = array()){
	    $arr = array();
	    foreach($matriks as $key => $val){
	        $arr[$key] = $total_baris[$key] / (count($val) - 1);
	    }
	    return $arr;
	}

	// Mencari nilai entering
	function get_entering($matriks = array(), $total_kolom = array()){
	    $arr = array();
	    foreach($matriks as $key => $val){
	        $arr[$key] = $total_kolom[$key] / (count($val) - 1);
	    }
	    return $arr;
	}

	// Mencari nilai net flow berdasarkan leaving dan entering
	function get_net_flow($leaving = array(), $entering = array()){
	    $arr = array();
	    foreach($leaving as $key => $val){
	        $arr[$key] = $val - $entering[$key];
	    }
	    return $arr;
	}

	// Mencari rangking berdasarkan net flow terbesar
	function get_rank($array){
	    $data = $array;
	    arsort($data);
	    $no=1;
	    $new = array();
	    foreach($data as $key => $value){
	        $new[$key] = $no++;
	    }
	    return $new;
	}

	// Mengambil data nilai alternatif untuk setiap kriteria
	function get_data(){
	    global $database;
	    $rows = $database->get_results("SELECT jenis_tanaman.id_jenis_tanaman, kriteria.id_kriteria, relasi.nilai
	        FROM tbl_jenis_tanaman jenis_tanaman
	        	INNER JOIN tbl_relasi relasi ON relasi.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman
	        	INNER JOIN tbl_kriteria kriteria ON kriteria.id_kriteria=relasi.id_kriteria
	        ORDER BY jenis_tanaman.id_jenis_tanaman, kriteria.id_kriteria");
	    $data = array();
	    foreach($rows as $row){
	        $data[$row->id_jenis_tanaman][$row->id_kriteria] = $row->nilai;
	    }
	    return $data;
	}

	// HTML select untuk minimal dan maksimal
	function get_kaidah_min_max_option($selected = ''){
	    $atribut = array(
	    	'Minimal'=>'Minimal',
	    	'Maksimal'=>'Maksimal'
	    	);   
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}

	// HTML select untuk tipe preferensi
	function get_tipe_preferensi_option($selected = ''){
	    $atribut = array(
	        '1'=>'Usual',
	        '2'=>'Quasi', 
	        '3'=>'Linier', 
	        '4'=>'Level', 
	        '5'=>'Linier Quasi'
	    );
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}

	// HTML select untuk nama lokasi
	function get_nama_lokasi_option($selected = ''){
	    $atribut = array(
	        'Kota Cirebon'=>'Kota Cirebon',
	        'Kabupaten Cirebon'=>'Kabupaten Cirebon'
	    );
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}

	// HTML select untuk lama penyinaran
	function get_lama_penyinaran_option($selected = ''){
	    $atribut = array(
	        '1'=>'1',
	        '2'=>'2',
	        '3'=>'3',
	        '4'=>'4',
	        '5'=>'5',
	        '6'=>'6',
	        '7'=>'7',
	        '8'=>'8',
	        '9'=>'9',
	        '10'=>'10',
	        '11'=>'11',
	        '12'=>'12'
	    );
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}

	// HTML select untuk drainase
	function get_drainase_option($selected = ''){
	    $atribut = array(
	        '20'=>'Terhambat',
	        '40'=>'Agak Terhambat',
	        '60'=>'Sedang',
	        '80'=>'Agak Lancar',
	        '100'=>'Lancar'
	    );
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}

	// HTML select untuk tekstur tanah
	function get_tekstur_tanah_option($selected = ''){
	    $atribut = array(
	        '20'=>'Kasar',
	        '40'=>'Agak Kasar',
	        '60'=>'Sedang',
	        '80'=>'Agak Halus',
	        '100'=>'Halus'
	    );
	    foreach($atribut as $key => $value){
	        if($selected==$key)
	            $a.="<option value='$key' selected>$value</option>";
	        else
	            $a.= "<option value='$key'>$value</option>";
	    }
	    return $a;
	}
	
?>