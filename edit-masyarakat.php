<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$data = $dbc->prepare("SELECT * FROM dusun where id={$_GET['id']} ");
$data->execute();
$dusun = $data->fetchAll()[0];

$dm = $dbc->prepare("SELECT * FROM masyarakat where id_masyarakat={$_GET['id_masyarakat']} ");
$dm->execute();
$masyarakat = $dm->fetchAll()[0];

$page_title = "Edit Masyarakat {$dusun['nama']}";

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h1><?= $page_title ?></h1>
    </div>
    <form action="edit-masyarakat-proses.php?id=<?= $masyarakat['id_masyarakat']?>" method="post">
        <table class="table table-hover">
            <input type="hidden" name="id_dusun" value="<?= $masyarakat['id_dusun'] ?>">
            <tr>
                <td>NIK</td>
                <td><input type="number" autocomplete="off" required class="form-control" value="<?= $masyarakat['nik'] ?>" name="nik"></td>
            </tr>
            <tr>
                <td>No KK</td>
                <td><input type="number" autocomplete="off" required class="form-control" value="<?= $masyarakat['no_kk'] ?>" name="no_kk"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" autocomplete="off" required class="form-control" value="<?= $masyarakat['nama'] ?>" name="nama"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" class="form-control"><?= $masyarakat['alamat'] ?></textarea></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td><input type="text" autocomplete="off" required class="form-control" value="<?= $masyarakat['tempat_lahir'] ?>" name="tempat_lahir"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="date" autocomplete="off" required class="form-control" value="<?= $masyarakat['tgl_lahir'] ?>" name="tgl_lahir"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="l" <?= ($masyarakat['jenis_kelamin'] == 'l') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="p" <?= ($masyarakat['jenis_kelamin'] == 'p') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </td>
            </tr>
        </table>
        <hr>
        <div>
            <input class="btn btn-primary" name="tambah" value="Update" type="submit">
        </div>
         
    </form>
</div>

<script>
    const tbl = `

    `

    function multiple() {
        $('#table-input').append(tbl)
    }
    multiple()
</script>
<?php
include './includes/footer.php';
?>
