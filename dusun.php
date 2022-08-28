<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$req = $dbc->prepare("SELECT * FROM dusun ");
$req->execute();

$dusun = $req->fetchAll();

$page_title = 'Dusun';

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h1>Dusun</h1>
    </div>
    <?php
    if ($dusun) {
        ?>
        <table class="table table-bordered bg-primary">
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-4">Nama</th>
                <th class="col-md-2">Aksi</th>
            </tr>
            <?php
            for($i = 0; $i < count($dusun); $i++) {
                echo '<tr>
                <td>'.($i+1).'</td>
                <td>'.$dusun[$i]['nama'].'</td>
                <td>
                    <a href="hapus-dusun.php?id='.$dusun[$i]['id'].'" class="btn btn-danger">Hapus</a>
                </td>
            </tr>';
            }
            ?>
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
