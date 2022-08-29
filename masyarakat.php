<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$data = $dbc->prepare("SELECT * FROM dusun where id={$_GET['id']} ");
$data->execute();
$dusun = $data->fetchAll()[0];


$req = $dbc->prepare("SELECT * FROM masyarakat where id_dusun={$_GET['id']}");
$req->execute();
$masyarakat = $req->fetchAll();

$page_title = "Masyarakat {$dusun['nama']}";

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h1><?= $page_title ?></h1>
    </div>
    <a href="tambah-masyarakat.php?id=<?= $_GET['id'] ?>" class="btn btn-primary">Tambah Masyarakat</a>
    <br><br>
    <?php
    if ($dusun) {
        ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 0; $i < count($masyarakat); $i++) { ?>
                <tr>
                    <td> <?= ($i+1) ?></td>
                    <td> <?= $masyarakat[$i]['nama'] ?></td>
                    <td>
                        <a href="hapus-masyarakat.php?id_dusun=<?= $_GET['id'] ?>&id=<?= $masyarakat[$i]['id_masyarakat'] ?>" class="btn btn-danger" >Hapus</a>
                        <a href="edit-masyarakat.php?id=<?= $_GET['id'] ?>&id_masyarakat=<?= $masyarakat[$i]['id_masyarakat'] ?>" class="btn btn-warning" >Edit</a>
                    </td>
                </tr>
                <?php }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo '<div class="well well-lg text-center">
                <strong>Tidak ada data yang disimpan.</strong>
            </div>';
    }
    ?>
</div>
<script>
    $(function() {
        $('.btn.btn-danger').click(function(e) {
            e.preventDefault();
            var konfirmasi = confirm('Yakin ingin dihapus?');
            if (konfirmasi == true) {
                window.location = this.href;
            }
        });
    });
</script>
<?php
include './includes/footer.php';
?>
