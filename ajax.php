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

$req = $dbc->prepare("SELECT * FROM $table ");
$req->execute();

$data = $req->fetchAll();

echo json_encode($data);

?>