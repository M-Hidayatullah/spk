<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: dusun.php');
    exit;
}

$req = $dbc->prepare("DELETE FROM dusun WHERE id = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

header('Location: dusun.php');
