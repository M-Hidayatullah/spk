<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$data = $dbc->prepare("SELECT * FROM dusun where id={$_GET['id']} ");
$data->execute();
$dusun = $data->fetchAll()[0];

$page_title = "Tambah Masyarakat {$dusun['nama']}";

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h1><?= $page_title ?></h1>
    </div>
    <form action="tambah-masyarakat-proses.php?id=<?=$_GET['id']?>" method="post">
        <div id="table-input"></div>
        <div>
            <input class="btn btn-primary" name="tambah" value="Simpan" type="submit">
            <button onclick="multiple()" type="button" class="btn btn-success">Tambah</button>
        </div>
         
    </form>
</div>

<script>
    const tbl = `
    <table class="table table-hover">
        <tr>
            <td>NIK</td>
            <td><input type="number" autocomplete="off" required class="form-control" name="nik[]"></td>
        </tr>
        <tr>
            <td>No KK</td>
            <td><input type="number" autocomplete="off" required class="form-control" name="no_kk[]"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" autocomplete="off" required class="form-control" name="nama[]"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><textarea name="alamat[]" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><input type="text" autocomplete="off" required class="form-control" name="tempat_lahir[]"></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><input type="date" autocomplete="off" required class="form-control" name="tgl_lahir[]"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>
                <select name="jenis_kelamin[]" class="form-control">
                    <option value="l">Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    `

    function multiple() {
        $('#table-input').append(tbl)
    }
    multiple()
</script>
<?php
include './includes/footer.php';
?>
