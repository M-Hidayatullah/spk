<?php 

require 'includes/config.php';

for ($i=0; $i < count($_POST['nik']); $i++) { 
	$sql = "INSERT INTO masyarakat(nik, no_kk, nama, alamat, tempat_lahir, tgl_lahir, jenis_kelamin, id_dusun) VALUES(
		'{$_POST['nik'][$i]}', 
		'{$_POST['no_kk'][$i]}', 
		'{$_POST['nama'][$i]}', 
		'{$_POST['alamat'][$i]}', 
		'{$_POST['tempat_lahir'][$i]}', 
		'{$_POST['tgl_lahir'][$i]}', 
		'{$_POST['jenis_kelamin'][$i]}', 
		{$_GET['id']}
	)";
	$dbc->exec($sql);
}

header('Location: masyarakat.php?id='.$_GET['id']);

 ?>