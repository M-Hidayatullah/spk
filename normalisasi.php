<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['nilai-alternatif'])) {
    header('Location: nilai-alternatif.php');
    exit;
} else {
    $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $pemilihan = $req->fetch();

    $req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $alternatif = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $nilaiAlternatif = $req->fetchAll();
}

$r = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

$max_or_min = array(
    $nilaiAlternatif[0]['c1'],
    $nilaiAlternatif[0]['c2'],
    $nilaiAlternatif[0]['c3'],
    $nilaiAlternatif[0]['c4'],
    $nilaiAlternatif[0]['c5'],
    $nilaiAlternatif[0]['c6']
);

for ($i = 0; $i < count($alternatif); $i++) {
    if ($nilaiAlternatif[$i]['c1'] > $max_or_min[0]) {
        $max_or_min[0] = $nilaiAlternatif[$i]['c1'];
    }

    if ($nilaiAlternatif[$i]['c2'] > $max_or_min[1]) {
        $max_or_min[1] = $nilaiAlternatif[$i]['c2'];
    }

    if ($nilaiAlternatif[$i]['c3'] > $max_or_min[2]) {
        $max_or_min[2] = $nilaiAlternatif[$i]['c3'];
    }

    if ($nilaiAlternatif[$i]['c4'] < $max_or_min[3]) {
        $max_or_min[3] = $nilaiAlternatif[$i]['c4'];
    }

    if ($nilaiAlternatif[$i]['c5'] < $max_or_min[4]) {
        $max_or_min[4] = $nilaiAlternatif[$i]['c5'];
    }

    if ($nilaiAlternatif[$i]['c6'] < $max_or_min[5]) {
        $max_or_min[5] = $nilaiAlternatif[$i]['c6'];
    }
}

for ($i = 0; $i < count($alternatif); $i++) {
    $r[0][] = round($nilaiAlternatif[$i]['c1']/$max_or_min[0], 4);
    $r[1][] = round($nilaiAlternatif[$i]['c2']/$max_or_min[1], 4);
    $r[2][] = round($nilaiAlternatif[$i]['c3']/$max_or_min[2], 4);
    $r[3][] = round($max_or_min[3]/$nilaiAlternatif[$i]['c4'], 4);
    $r[4][] = round($max_or_min[4]/$nilaiAlternatif[$i]['c5'], 4);
    $r[5][] = round($max_or_min[5]/$nilaiAlternatif[$i]['c6'], 4);
}

$status = "normalisasi";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM normalisasi WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO normalisasi VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $r[0][$i]);
        $req->bindValue(':c2', $r[1][$i]);
        $req->bindValue(':c3', $r[2][$i]);
        $req->bindValue(':c4', $r[3][$i]);
        $req->bindValue(':c5', $r[4][$i]);
        $req->bindValue(':c6', $r[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['normalisasi'] = true;
} catch (PDOException $e) {
    $dbc->rollback();
}

$page_title = 'Normalisasi';

include './includes/header.php';
?>

<div class="col-md-12 bg-primary">
    <div class="page-header text-center">
        <h1>Pemilihan Penerima BLT</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
    <h3>Normalisasi Matriks</h3>
    <table class="table table-bordered">
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
                    <td class="col-md-1">'.$r[0][$i].'</td>
                    <td class="col-md-1">'.$r[1][$i].'</td>
                    <td class="col-md-1">'.$r[2][$i].'</td>
                    <td class="col-md-1">'.$r[3][$i].'</td>
                    <td class="col-md-1">'.$r[4][$i].'</td>
                    <td class="col-md-1">'.$r[5][$i].'</td>
                </tr>';
        }
        ?>
    </table>
    <br/>
    <div class="row">
        <div class="col-md-6 text-left">
            <a class="btn btn-success" href="nilai-alternatif.php">&laquo; Nilai</a>
        </div>
        <div class="text-right">
            <a class="btn btn-danger" href="ranking.php">Perankingan &raquo;</a>
        </div>
    </div>
</div>

<?php
include './includes/footer.php';
?>
