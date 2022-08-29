<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) && !isset($_GET['id_dusun'])) {
    header('Location: dusun.php');
    exit;
}

$req = $dbc->prepare("DELETE FROM masyarakat WHERE id_masyarakat = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

header('Location: masyarakat.php?id='.$_GET['id_dusun']);
