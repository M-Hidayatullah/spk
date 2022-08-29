<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$table = 'dusun';

if (isset($_GET['table'])) {
	$table = $_GET['table'];
}

$table .= " where {$_GET['kolom']} like '%{$_GET['cari']}%' ";

if (isset($_GET['id_dusun'])) {
	$table .= " and id_dusun = {$_GET['id_dusun']}";
}

$req = $dbc->prepare("SELECT * FROM $table limit 10");
$req->execute();

$data = $req->fetchAll();

echo json_encode($data);

?>