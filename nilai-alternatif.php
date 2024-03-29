<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['alternatif'])) {
    header('Location: alternatif.php');
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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errNilaiAlternatif = false;

    $errC = array(
        array(),
        array(),
        array(),
        array(),
        array(),
        array()
    );

    $c = $_POST['c'];

    $criteriaC1 = array("options" => array("min_range"=>1, "max_range"=>60));
    $criteriaC2 = array("options" => array("min_range"=>1, "max_range"=>50));
    $criteriaC3 = array("options" => array("min_range"=>1));
    $criteriaC4 = array("options" => array("min_range"=>1, "max_range"=>20));
    $criteriaC5 = array("options" => array("min_range"=>1, "max_range"=>30));
    $criteriaC6 = array("options" => array("min_range"=>1, "max_range"=>40));

    for($i = 0; $i < count($alternatif); $i++) {
        if (filter_var($c[0][$i], FILTER_VALIDATE_INT, $criteriaC1) === false) {
            $errC[0][] = $i;
        }

        if (filter_var($c[1][$i], FILTER_VALIDATE_INT, $criteriaC2) === false) {
            $errC[1][] = $i;
        }

        if (filter_var($c[2][$i], FILTER_VALIDATE_INT, $criteriaC3) === false) {
            $errC[2][] = $i;
        }

        if (filter_var($c[3][$i], FILTER_VALIDATE_INT, $criteriaC4) === false) {
            $errC[3][] = $i;
        }

        if (filter_var($c[4][$i], FILTER_VALIDATE_INT, $criteriaC5) === false) {
            $errC[4][] = $i;
        }

        if (filter_var($c[5][$i], FILTER_VALIDATE_INT, $criteriaC6) === false) {
            $errC[5][] = $i;
        }
    }

    for ($i = 0; $i < count($errC); $i++) {
        if (!empty($errC[$i]) ) {
            $errNilaiAlternatif = true;
        }
    }

    if (!$errNilaiAlternatif) {
        unset($_SESSION['c']);
        unset($_SESSION['errNilaiAlternatif']);
        unset($_SESSION['errC']);
        $status = "nilai-alternatif";

        try {
            $dbc->beginTransaction();

            $dbc->exec("DELETE FROM nilai WHERE id_pemilihan = $_SESSION[id]");

            $req = $dbc->prepare("INSERT INTO nilai VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
            $req->bindValue(':id', $_SESSION['id']);

            for ($i = 0; $i<count($alternatif); $i++) {
                $req->bindValue(':c1', $_POST['c'][0][$i]);
                $req->bindValue(':c2', $_POST['c'][1][$i]);
                $req->bindValue(':c3', $_POST['c'][2][$i]);
                $req->bindValue(':c4', $_POST['c'][3][$i]);
                $req->bindValue(':c5', $_POST['c'][4][$i]);
                $req->bindValue(':c6', $_POST['c'][5][$i]);
                $req->execute();
            }

            $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
            $req->bindParam(1, $status);
            $req->bindParam(2, $_SESSION['id']);
            $req->execute();

            $dbc->commit();

            $_SESSION['nilai-alternatif'] = true;
            header('Location: normalisasi.php');
            exit;
        } catch (PDOException $e) {
            $dbc->rollback();
        }
    } else {
        $_SESSION['c'] = $_POST['c'];
        $_SESSION['errNilaiAlternatif'] = $errNilaiAlternatif;
        $_SESSION['errC'] = $errC;

        header('Location: nilai-alternatif.php');
    }
} else {
    $req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $nilai = $req->fetchAll();
}

$page_title = 'Nilai Alternatif';

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center bg-primary">
        <h1>Pemberian Nilai Kriteria Penerima BLT</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
    <h3>Nilai Alternatif</h3>
    <form method="post">
        <?php
        if (isset($_SESSION['errNilaiAlternatif']) && $_SESSION['errNilaiAlternatif']) {
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Nilai</strong> tidak valid.
                </div>';
        }
        ?>
        <table class="table table-bordered bg-primary">
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">Alternatif</th>
                <th class="col-md-1">Disabilitas</th>
                <th class="col-md-1">Yatim Piatu</th>
                <th class="col-md-1">Lansia</th>
                <th class="col-md-1">Janda</th>
                <th class="col-md-1">Jompo</th>
                <th class="col-md-1">Penyakit Menahun</th>
            </tr>
            <?php
            if (isset($_SESSION['errNilaiAlternatif']) && $_SESSION['errNilaiAlternatif']) {
                for($i = 0; $i < count($alternatif); $i++) {
                    echo '<tr>
                            <td class="col-md-1">'.($i+1).'</td>
                            <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>';

                    if (in_array($i, $_SESSION['errC'][0])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[0][]" value="'.$_SESSION['c'][0][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[0][]" value="'.$_SESSION['c'][0][$i].'"/></td>';
                    }

                    if (in_array($i, $_SESSION['errC'][1])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[1][]" value="'.$_SESSION['c'][1][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[1][]" value="'.$_SESSION['c'][1][$i].'"/></td>';
                    }

                    if (in_array($i, $_SESSION['errC'][2])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[2][]" value="'.$_SESSION['c'][2][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[2][]" value="'.$_SESSION['c'][2][$i].'"/></td>';
                    }

                    if (in_array($i, $_SESSION['errC'][3])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[3][]" value="'.$_SESSION['c'][3][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[3][]" value="'.$_SESSION['c'][3][$i].'"/></td>';
                    }

                    if (in_array($i, $_SESSION['errC'][4])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[4][]" value="'.$_SESSION['c'][4][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[4][]" value="'.$_SESSION['c'][4][$i].'"/></td>';
                    }

                    if (in_array($i, $_SESSION['errC'][5])) {
                        echo '<td class="col-md-1 has-error"><input class="form-control" type="text" name="c[5][]" value="'.$_SESSION['c'][5][$i].'"/></td>';
                    } else {
                        echo '<td class="col-md-1"><input class="form-control" type="text" name="c[5][]" value="'.$_SESSION['c'][5][$i].'"/></td>';
                    }
                    echo '</tr>';
                }
            } else if (isset($nilai) && $nilai ) {
                for($i = 0; $i < count($alternatif); $i++) {
                    if (isset($nilai[$i])) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[0][]" placeholder="1 - 60" value="'.$nilai[$i]['c1'].'"/></td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[1][]" placeholder="1 - 50" value="'.$nilai[$i]['c2'].'"/></td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[2][]" placeholder="70" value="'.$nilai[$i]['c3'].'"/></td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[3][]" placeholder="1 - 15" value="'.$nilai[$i]['c4'].'"/></td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[4][]" placeholder="1 - 30" value="'.$nilai[$i]['c5'].'"/></td>
                                <td class="col-md-1"><input class="form-control" type="text" name="c[5][]" placeholder="1 - 40" value="'.$nilai[$i]['c6'].'"/></td>
                            </tr>';
                    } else {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1"><select class="form-control" name="c[0][]">
	                           <option value="" disabled selected>1 - 60</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                </select></td>
                                <td class="col-md-1"><select class="form-control" name="c[1][]">
	                           <option value="" disabled selected>1 - 50</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                </select></td>
                                <td class="col-md-1"><select class="form-control" name="c[2][]">
	                           <option value="" disabled selected>1 - 70</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                </select></td>
                                <td class="col-md-1"><select class="form-control" name="c[3][]">
	                           <option value="" disabled selected>1 - 15</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                </select></td>
                                <td class="col-md-1"><select class="form-control" name="c[4][]">
	                           <option value="" disabled selected>1 - 30</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                </select><select class="form-control" name="c[4][]">
	                           <option value="" disabled selected>1 - 30</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                </select></td>
                                <td class="col-md-1"><select class="form-control" name="c[5][]">
	                           <option value="" disabled selected>1 - 40</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                </select></td>
                            </tr>';
                    }
                }
            } else {
                for($i = 0; $i < count($alternatif); $i++) {
                    echo '<tr>
                            <td class="col-md-1">'.($i+1).'</td>
                            <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                            <td class="col-md-1"><select class="form-control" name="c[0][]">
	                           <option value="" disabled selected>1 - 60</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                </select></td>
                            <td class="col-md-1"><select class="form-control" name="c[1][]">
	                           <option value="" disabled selected>1 - 50</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                </select></td>
                            <td class="col-md-1"><select class="form-control" name="c[2][]">
	                           <option value="" disabled selected>1 - 70</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                </select></td>
                            <td class="col-md-1"><select class="form-control" name="c[3][]">
	                           <option value="" disabled selected>1 - 15</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                </select></td>
                            <td class="col-md-1"><select class="form-control" name="c[4][]">
	                           <option value="" disabled selected>1 - 30</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                </select></td>
                            <td class="col-md-1"><select class="form-control" name="c[5][]">
	                           <option value="" disabled selected>1 - 40</option>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                </select></td>
                        </tr>';
                }
            }
            ?>
        </table>
        <br/>
        <div class="row">
            <div class="col-md-6 text-left">
                <a class="btn btn-primary" href="alternatif.php">&laquo; Alternatif</a>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Normalisasi &raquo;</button>
            </div>
        </div>
    </br/>
    </form>
</div>

<?php
include './includes/footer.php';
?>
