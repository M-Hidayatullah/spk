<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$table = 'dusun';

if (isset($_GET['table'])) {
	$table = $_GET['table'];
	if (isset($_GET['id_dusun'])) {
		$table .= " where id_dusun = {$_GET['id_dusun']}";
	}
}

$req = $dbc->prepare("SELECT * FROM $table ");
$req->execute();

$data = $req->fetchAll();

echo json_encode($data);

?>