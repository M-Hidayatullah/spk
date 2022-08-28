<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $err = false;

    if (!preg_match ('/^[A-Z0-9 \'.-]{2,255}$/i', $_POST['keterangan'])) {
        $err = true;
    }

    if (!$err) {
      unset($_SESSION['errInformasi']);
      $status = "id";

      if (isset($_SESSION['id'])) {
         $req = $dbc->prepare('UPDATE pemilihan SET keterangan = ? WHERE id = ?');
         $req->bindParam(1, $_POST['keterangan']);
         $req->bindParam(2, $_SESSION['id']);
         $req->execute();
      } else {
         $req = $dbc->prepare('INSERT INTO pemilihan VALUES(NULL, ?, NOW(), ?)');
         $req->bindParam(1, $_POST['keterangan']);
         $req->bindParam(2, $status);
         $req->execute();

         $_SESSION['id'] = $dbc->lastInsertId();
      }

      header('Location: alternatif.php');
      exit;
    } else {
      $_SESSION['errInformasi'] = true;

      header('Location: informasi-pemilihan.php');
      exit;
   }
} else if (isset($_SESSION['id'])) {
   $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
   $req->bindParam(1, $_SESSION['id']);
   $req->execute();

   $pemilihan = $req->fetch();
}

$page_title = 'Informasi Pemilihan';

include './includes/header.php';
?>
<div class="col-md-4 col-md-offset-4">
    <div class="page-header bg-primary">
        <h1 class="text-center">Pemilihan Data Dusun</h1>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input list="keterangan_list" type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan"
            <?php if (isset($pemilihan)) echo 'value="'.$pemilihan['keterangan'].'"'?>
            >
            <datalist id="keterangan_list"></datalist>
        </div>
        <button type="submit" class="btn btn-primary">Alternatif &raquo;</button>
    </form>
    <br />
    <?php
    if (isset($_SESSION['errInformasi'])) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">

              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Keterangan</strong> tidak boleh kosong.
            </div>';
    }
    ?>
</div>

<script type="text/javascript">
  $(document).ready(() => {

    $.ajax({
      url: "http://localhost/spk/ajax.php",
      success: function(result){
        listDusun = JSON.parse(result)
        listDusun.forEach((i) => {
          $('#keterangan_list').append(`<option value="${i.nama}">`)
        })
      }
    })

  })
</script>

<?php
include './includes/footer.php';
?>
