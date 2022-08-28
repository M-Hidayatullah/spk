<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: laporan.php');
    exit;
}

$req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$pemilihan = $req->fetch();

$req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$alternatif = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$nilai = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM normalisasi WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$normalisasi = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM ranking WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$v = $req->fetchAll();

$page_title = 'Detail Laporan';

include './includes/header.php';
?>
<div class="col-md-12">
    <div class="page-header text-center bg-primary">
        <h1>Pemilihan Penerima BLT</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
    <h3>Tabel Nilai Alternatif</h3>
    <table class="table table-bordered bg-warning">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">Disabilitas</th>
            <th class="col-md-1">Yatim Piatu</th>
            <th class="col-md-1">Lansia</th>
            <th class="col-md-1">Janda</th>
            <th class="col-md-1">Jompo</th>
            <th class="col-md-1">Penyakit Menahun</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c1'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c2'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c3'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c4'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c5'].'</td>
                    <td class="col-md-1">'.$nilai[$i]['c6'].'</td>
                </tr>';
        }
        ?>
    </table>
    <hr />
    <h3>Tabel Normalisasi Matriks</h3>
    <table class="table table-bordered bg-warning">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">Disabilitas</th>
            <th class="col-md-1">Yatim Piatu</th>
            <th class="col-md-1">Lansia</th>
            <th class="col-md-1">Janda</th>
            <th class="col-md-1">Jompo</th>
            <th class="col-md-1">Penyakit Menahun</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c1'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c2'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c3'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c4'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c5'].'</td>
                    <td class="col-md-1">'.$normalisasi[$i]['c6'].'</td>
                </tr>';
        }
        ?>
    </table>
    <hr />
    <h3>Tabel Perankingan</h3>
    <table class="table table-bordered bg-success">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">V</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-10">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$v[$i]['v'].'</td>
                </tr>';
        }
        ?>
    </table>
    <hr />
    <?php
    $hasil = array();

    for($i = 0; $i < count($alternatif); $i++) {
        $hasil[] = array(
            "alternatif" => $alternatif[$i]['alternatif'],
            "v" => $v[$i]['v']
        );
    }

    usort($hasil, function($a, $b) {
        return $a['v'] < $b['v'];
    });
    ?>
    <h3>Tabel Hasil Akhir</h3>
    <table class="table table-bordered bg-success">
        <tr>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">V</th>
            <td class="col-md-1">Rank</td>
        </tr>
        <?php
        for($i = 0; $i < count($hasil); $i++) {
            echo '<tr>
                    <td class="col-md-3">'.$hasil[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$hasil[$i]['v'].'</td>
                    <td class="col-md-1">'.($i+1).'</td>
                </tr>';
        }
        ?>
    </table>
</div>
<?php
include './includes/footer.php';
?>
