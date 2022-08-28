<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$req = $dbc->prepare("SELECT * FROM dusun ");
$req->execute();

$data = $req->fetchAll();

echo json_encode($data);

?>