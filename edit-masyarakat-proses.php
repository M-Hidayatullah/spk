<?php 

require 'includes/config.php';

$sql = "UPDATE masyarakat set
	nik = '{$_POST['nik']}', 
	no_kk = '{$_POST['no_kk']}', 
	nama = '{$_POST['nama']}', 
	alamat = '{$_POST['alamat']}', 
	tempat_lahir = '{$_POST['tempat_lahir']}', 
	tgl_lahir = '{$_POST['tgl_lahir']}', 
	jenis_kelamin = '{$_POST['jenis_kelamin']}'
	where id_masyarakat = {$_GET['id']}
";
echo $sql;
$dbc->exec($sql);

header('Location: masyarakat.php?id='.$_POST['id_dusun']);

 ?>