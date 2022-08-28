<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['normalisasi'])) {
    header('Location: normalisasi.php');
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

    $req = $dbc->prepare("SELECT * FROM normalisasi WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $r = $req->fetchAll();
}

$w = array(0.3, 0.2, 0.2, 0.1, 0.1);
$v = array();

for ($i = 0; $i < count($alternatif); $i++) {
    $v[] = ($r[$i]['c1']*$w[0])+($r[$i]['c2']*$w[1])+($r[$i]['c3']*$w[2])+($r[$i]['c4']*$w[3])+($r[$i]['c5']*$w[4])+($r[$i]['c5']*$w[4]);
}

$status = "ranking";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM ranking WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO ranking VALUES(:id, :v)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':v', $v[$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['ranking'] = true;
} catch (PDOException $e) {
    $dbc->rollback();
}

$page_title = 'Perankingan';

include './includes/header.php';
?>

<div class="col-md-8 col-md-offset-2 bg-primary">
    <div class="page-header text-center">
        <h1>Pemilihan Penerima BLT</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
    <h3>Perankingan</h3>
    <table class="table table-bordered">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-4">Alternatif</th>
            <th class="col-md-2">V</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-4">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-2">'.$v[$i].'</td>
                </tr>';
        }
        ?>
    </table>
    <br/>
    <div class="row">
        <div class="col-md-6 text-left">
            <a class="btn btn-success" href="normalisasi.php">&laquo; Normalisasi</a>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-danger" href="hasil.php">Hasil &raquo;</a>
        </div>
    </div>
</div>
<?php
include './includes/footer.php';
?>
