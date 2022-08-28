    <?php
    require './includes/config.php';

    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
        exit;
    }

    include './includes/header.php';
    ?>

    <div class="col-md-12 bg-danger">
        <div class="page-header">
            <h1 class="text-center text-pimary">Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai
                <br>Menggunakan Metode SAW pada desa Karang Bajo Bayan
            </h1>
        </div>
        <h3>Kriteria Bantuan Langsung Tunai yang dibutuhkan</h3>
        <table class="table table-bordered btn-primary">
            <tr>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Atribut</th>
                <th>Nilai</th>
                <th>Bobot</th>
            </tr>
            <tr>
                <td>C1</td>
                <td>Disabilitas</td>
                <td>Benefit</td>
                <td>1 - 60</td>
                <td>30</td>
            </tr>
            <tr>
                <td>C2</td>
                <td>Yatim Piatu</td>
                <td>Benefit</td>
                <td>1 - 50 </td>
                <td>20</td>
            </tr>
            <tr>
                <td>C3</td>
                <td>Lansia</td>
                <td>Benefit</td>
                <td>1 - 70 </td>
                <td>20</td>
            </tr>
            <tr>
                <td>C4</td>
                <td>Janda</td>
                <td>Cost</td>
                <td>1 - 15</td>
                <td>10</td>
            </tr>
            <tr>
                <td>C5</td>
                <td>Jompo</td>
                <td>Cost</td>
                <td>1 - 30 </td>
                <td>10</td>
            </tr>
            <tr>
                <td>C6</td>
                <td>Penyakit Menahun</td>
                <td>Cost</td>
                <td>1 - 40 </td>
                <td>10</td>
            </tr>
        </table>
        <p class="text-right"><a href="informasi-pemilihan.php" class="btn btn-primary">Mulai</a></p>
    </div>
    <?php
    include './includes/footer.php';
    ?>