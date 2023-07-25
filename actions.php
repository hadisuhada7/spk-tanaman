<?php
    
    require_once 'functions.php';
    
    // Login 
    if ($mod=='login'){
        $username = esc_field($_POST['username']);
        $password = esc_field(md5($_POST['password']));
        
        $row = $database->get_row("SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
        if($row){
            $_SESSION['login'] = $row->username;
            $_SESSION['level'] = $row->level;
            redirect_js("index.php");
        } else {
            alert("Maaf, Username atau Password salah !!!");
        }          
    } else if ($mod=='password'){
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $password3 = $_POST['password3'];
        
        $row = $database->get_row("SELECT * FROM tbl_user WHERE username='$_SESSION[login]' AND password='$password1'");        
        
        if($password1=='' || $password2=='' || $password3=='')
            print_msg('Field yang bertanda * tidak boleh kosong !!!');
        elseif(!$row)
            print_msg('Password lama salah !!!');
        elseif( $password2 != $password3 )
            print_msg('Password baru dan konfirmasi Password baru tidak sama !!!');
        else {        
            $database->query("UPDATE tbl_user SET password='$password2' WHERE username='$_SESSION[login]'");                    
            print_msg('Password berhasil diubah.', 'success');
        }
    } elseif($act=='logout'){
        unset($_SESSION['login'], $_SESSION['level']);
        header("location:index.php?m=login");
    }

    // User
    elseif($mod=='tambah_user'){
        $id_user = $_POST['id_user'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_telepon = $_POST['no_telepon'];
        $level = $_POST['level'];
                
        if($id_user=='' || $nama_lengkap=='' || $username=='' || $password=='' || $tempat_lahir=='' || $tgl_lahir=='' || $jenis_kelamin=='' || $no_telepon=='' || $level=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_row("SELECT * FROM tbl_user WHERE id_user='$id_user' AND id_user<>'$_GET[ID]'")){
            print_msg("Id. User sudah ada !!!");    
        } elseif($database->get_row("SELECT * FROM tbl_user WHERE username='$username' AND id_user<>'$_GET[ID]'")){
            print_msg("Username sudah ada !!!");    
        } else {
            $database->query("INSERT INTO tbl_user (id_user, nama_lengkap, username, password, tempat_lahir, tgl_lahir, jenis_kelamin, no_telepon, level) 
                VALUES ('$id_user', '$nama_lengkap', '$username', '$password', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$no_telepon', '$level')");                                                           
            redirect_js("index.php?m=user");
        }
    } else if($mod=='edit_user'){
        $id_user = $_POST['id_user'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_telepon = $_POST['no_telepon'];
        $level = $_POST['level'];
                
        if($id_user=='' || $nama_lengkap=='' || $username=='' || $password=='' || $tempat_lahir=='' || $tgl_lahir=='' || $jenis_kelamin=='' || $no_telepon=='' || $level=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_row("SELECT * FROM tbl_user WHERE username='$username' AND id_user<>'$_GET[ID]'")){
            print_msg("Username sudah ada !!!");  
        } else {
            $database->query("UPDATE tbl_user SET nama_lengkap='$nama_lengkap', username='$username', password='$password', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jenis_kelamin='$jenis_kelamin', no_telepon='$no_telepon', level='$level' WHERE id_user='$_GET[ID]'");
            redirect_js("index.php?m=user");
        }
    } else if ($act=='delete_user'){
        $database->query("DELETE FROM tbl_user WHERE id_user='$_GET[ID]'");
        header("location:index.php?m=user");                    
    }

    // Kriteria
    if($mod=='tambah_kriteria'){
        $id_kriteria = $_POST['id_kriteria'];
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot = $_POST['bobot'];
        $kaidah_min_max = $_POST['kaidah_min_max'];
        $tipe_preferensi = $_POST['tipe_preferensi'];
        $parameter_q = $_POST['parameter_q'];
        $parameter_p = $_POST['parameter_p'];
        
        if($id_kriteria=='' || $nama_kriteria=='' || $bobot=='' || $kaidah_min_max=='' || $tipe_preferensi=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'"))
            print_msg("Id.Kriteria sudah ada !!!");
        else {
            $database->query("INSERT INTO tbl_kriteria (id_kriteria, nama_kriteria, bobot, kaidah_min_max, tipe_preferensi, parameter_q, parameter_p) 
                VALUES ('$id_kriteria', '$nama_kriteria', '$bobot', '$kaidah_min_max', '$tipe_preferensi', '$parameter_q', '$parameter_p')");
            $ID = $database->insert_id;        
            $database->query("INSERT INTO tbl_relasi (id_jenis_tanaman, id_kriteria, nilai) SELECT id_jenis_tanaman, '$ID', 0  FROM tbl_jenis_tanaman");           
            redirect_js("index.php?m=kriteria");
        }                    
    } else if($mod=='edit_kriteria'){
        $id_kriteria = $_POST['id_kriteria'];
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot = $_POST['bobot'];
        $kaidah_min_max = $_POST['kaidah_min_max'];
        $tipe_preferensi = $_POST['tipe_preferensi'];
        $parameter_q = $_POST['parameter_q'];
        $parameter_p = $_POST['parameter_p'];
        
        if($id_kriteria=='' || $nama_kriteria=='' || $bobot=='' || $kaidah_min_max=='' || $tipe_preferensi=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_kriteria WHERE id_kriteria='$id_kriteria' AND id_kriteria<>'$_GET[ID]'"))
            print_msg("Id.Kriteria sudah ada !!!");
        else{
            $database->query("UPDATE tbl_kriteria SET id_kriteria='$id_kriteria', nama_kriteria='$nama_kriteria', bobot='$bobot', kaidah_min_max='$kaidah_min_max', tipe_preferensi='$tipe_preferensi', parameter_q='$parameter_q', parameter_p='$parameter_p' WHERE id_kriteria='$_GET[ID]'");
            redirect_js("index.php?m=kriteria");
        }    
    } else if ($act=='delete_kriteria'){
        $database->query("DELETE FROM tbl_kriteria WHERE id_kriteria='$_GET[ID]'");
        $database->query("DELETE FROM tbl_relasi WHERE id_kriteria='$_GET[ID]'");
        header("location:index.php?m=kriteria");
    } 

    // Jenis Tanaman
    elseif($mod=='tambah_jenis_tanaman'){
        $id_jenis_tanaman = $_POST['id_jenis_tanaman'];
        $nama_tanaman = $_POST['nama_tanaman'];
        $keterangan = $_POST['keterangan'];

        if($id_jenis_tanaman=='' || $nama_tanaman=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'"))
            print_msg("Id. Jenis Tanaman sudah ada !!!");
        else {
            $database->query("INSERT INTO tbl_jenis_tanaman (id_jenis_tanaman, nama_tanaman, keterangan) 
                VALUES ('$id_jenis_tanaman', '$nama_tanaman', '$keterangan')");
            $ID = $database->get_var("SELECT id_jenis_tanaman FROM tbl_jenis_tanaman ORDER BY id_jenis_tanaman DESC LIMIT 1");            
            $database->query("INSERT INTO tbl_relasi (id_jenis_tanaman, id_kriteria, nilai) SELECT '$ID', id_kriteria, 0 FROM tbl_kriteria");       
            redirect_js("index.php?m=jenis_tanaman");
        }
    } else if($mod=='edit_jenis_tanaman'){
        $id_jenis_tanaman = $_POST['id_jenis_tanaman'];
        $nama_tanaman = $_POST['nama_tanaman'];
        $keterangan = $_POST['keterangan'];
        
        if($id_jenis_tanaman=='' || $nama_tanaman=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman' AND id_jenis_tanaman<>'$_GET[ID]'"))
            print_msg("Id. Jenis Tanaman sudah ada !!!");
        else {
            $database->query("UPDATE tbl_jenis_tanaman SET id_jenis_tanaman='$id_jenis_tanaman', nama_tanaman='$nama_tanaman', keterangan='$keterangan' WHERE id_jenis_tanaman='$_GET[ID]'");
            redirect_js("index.php?m=jenis_tanaman");
        }
    } else if ($act=='delete_jenis_tanaman'){
        $database->query("DELETE FROM tbl_jenis_tanaman WHERE id_jenis_tanaman='$_GET[ID]'");
        $database->query("DELETE FROM tbl_relasi WHERE id_jenis_tanaman='$_GET[ID]'");
        header("location:index.php?m=jenis_tanaman");
    }

    // Karakteristik Lahan
    elseif($mod=='tambah_karakteristik_lahan'){
        $id_karakteristik_lahan = $_POST['id_karakteristik_lahan'];
        $nama_lokasi = $_POST['nama_lokasi'];
        $ketinggian = $_POST['ketinggian'];
        $temperatur_udara = $_POST['temperatur_udara'];
        $curah_hujan = $_POST['curah_hujan'];
        $lama_penyinaran = $_POST['lama_penyinaran'];
        $kelembaban_udara = $_POST['kelembaban_udara'];
        $drainase = $_POST['drainase'];
        $tekstur_tanah = $_POST['tekstur_tanah'];
        $reaksi_tanah = $_POST['reaksi_tanah'];

        if($id_karakteristik_lahan=='' || $nama_lokasi=='' || $ketinggian=='' || $temperatur_udara=='' || $curah_hujan=='' || $lama_penyinaran=='' || $kelembaban_udara=='' || $drainase=='' || $tekstur_tanah=='' || $reaksi_tanah=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_karakteristik_lahan WHERE id_karakteristik_lahan='$id_karakteristik_lahan'"))
            print_msg("Id. Karakteristik Lahan sudah ada !!!");
        else {
            $database->query("INSERT INTO tbl_karakteristik_lahan (id_karakteristik_lahan, nama_lokasi, ketinggian, temperatur_udara, curah_hujan, lama_penyinaran, kelembaban_udara, drainase, tekstur_tanah, reaksi_tanah) 
                VALUES ('$id_karakteristik_lahan', '$nama_lokasi', '$ketinggian', '$temperatur_udara', '$curah_hujan', '$lama_penyinaran', '$kelembaban_udara', '$drainase', '$tekstur_tanah', '$reaksi_tanah')");       
            redirect_js("index.php?m=karakteristik_lahan");
        }
    } else if($mod=='edit_karakteristik_lahan'){
        $id_karakteristik_lahan = $_POST['id_karakteristik_lahan'];
        $nama_lokasi = $_POST['nama_lokasi'];
        $ketinggian = $_POST['ketinggian'];
        $temperatur_udara = $_POST['temperatur_udara'];
        $curah_hujan = $_POST['curah_hujan'];
        $lama_penyinaran = $_POST['lama_penyinaran'];
        $kelembaban_udara = $_POST['kelembaban_udara'];
        $drainase = $_POST['drainase'];
        $tekstur_tanah = $_POST['tekstur_tanah'];
        $reaksi_tanah = $_POST['reaksi_tanah'];
        
        if($id_karakteristik_lahan=='' || $nama_lokasi=='' || $ketinggian=='' || $temperatur_udara=='' || $curah_hujan=='' || $lama_penyinaran=='' || $kelembaban_udara=='' || $drainase=='' || $tekstur_tanah=='' || $reaksi_tanah=='')
            print_msg("Field yang bertanda * tidak boleh kosong !!!");
        elseif($database->get_results("SELECT * FROM tbl_karakteristik_lahan WHERE id_karakteristik_lahan='$id_karakteristik_lahan' AND id_karakteristik_lahan<>'$_GET[ID]'"))
            print_msg("Id. Karakteristik Lahan sudah ada !!!");
        else {
            $database->query("UPDATE tbl_karakteristik_lahan SET id_karakteristik_lahan='$id_karakteristik_lahan', nama_lokasi='$nama_lokasi', ketinggian='$ketinggian', temperatur_udara='$temperatur_udara', curah_hujan='$curah_hujan', lama_penyinaran='$lama_penyinaran', kelembaban_udara='$kelembaban_udara', drainase='$drainase', tekstur_tanah='$tekstur_tanah', reaksi_tanah='$reaksi_tanah' WHERE id_karakteristik_lahan='$_GET[ID]'");
            redirect_js("index.php?m=karakteristik_lahan");
        }
    } else if ($act=='delete_karakteristik_lahan'){
        $database->query("DELETE FROM tbl_karakteristik_lahan WHERE id_karakteristik_lahan='$_GET[ID]'");
        header("location:index.php?m=karakteristik_lahan");
    }
        
    // Relasi
    else if ($act=='edit_relasi'){
        foreach($_POST as $key => $value){
            $ID = str_replace('ID-', '', $key);
            $database->query("UPDATE tbl_relasi SET nilai='$value' WHERE id_relasi='$ID'");
        }
        header("location:index.php?m=relasi");
    } 

?>