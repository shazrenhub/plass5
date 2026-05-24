<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan guard-aktiviti.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');
?>

<h3>Laporan Kehadiran Subjek</h3>
<!-- Borang carian Subjek-->
<form action='' method='GET'>
    Subjek <select name='idsub'>
        <option selected disabled value>Sila Pilih Subjek</option>

        <?php
        # Proses memaparkan senarai subjek dalam bentuk drop down list
        $arahan_sql_pilih = "SELECT idsub, subjek FROM subjek";
        $laksana_arahan_pilih = mysqli_query($condb, $arahan_sql_pilih);
        while ($n = mysqli_fetch_array($laksana_arahan_pilih)) {
            echo "<option value='" . $n['idsub'] . "'>" . $n['subjek'] . "</option>";
        }
        ?>
    </select>
    <input type='submit' value='Cari'>
</form>

<?php
if (!empty($_GET['idsub'])) {
    # Mengambil nilai data GET di URL
    $idsub = $_GET['idsub'];

    # proses mendapatkan maklumat subjek
    $sql_aktiviti = "SELECT * FROM subjek WHERE idsub = '$idsub'";
    $laksana_aktiviti = mysqli_query($condb, $sql_aktiviti);
    $ma = mysqli_fetch_array($laksana_aktiviti);

    # Mendapatkan Analisis Kehadiran (bil hadir & bil ahli)
    $arahanSQL = "SELECT
        (SELECT COUNT(*) FROM kelastambahan WHERE idsub = '$idsub') AS bil_hadir,
        (SELECT COUNT(*) FROM pelajar) AS bil_ahli";
    $laksanaSQL = mysqli_query($condb, $arahanSQL);
    $da = mysqli_fetch_array($laksanaSQL);
    ?>

    <!-- Header bagi jadual untuk memaparkan senarai subjek -->
    <h3>
        <?= $ma['subjek'] ?><br>
        <?= $ma['tarikh'] ?> | <?= $ma['masa'] ?><br>
        Kehadiran: <?= $da['bil_hadir'] . " / " . $da['bil_ahli'] ?><br>
        Peratus: <?= number_format(($da['bil_hadir'] / $da['bil_ahli'] * 100), 2); ?> %
    </h3>

    <!-- Borang carian Nama Murid-->
    <form action='kehadiran-laporan.php?idsub=<?= $idsub; ?>' method='POST' style="margin:0; padding:0;">
        <input type='text' name='nama' placeholder='Carian Nama Murid'>
        <input type='submit' value='Cari'>
    </form>

    <table align='center' width='100%' border='1' id='saiz'>
        <tr bgcolor='#7B6464'>
            <td colspan='5' align='right'>
                <?php include('butang-saiz.php'); ?>
            </td>
        </tr>
        <tr bgcolor='#555555' align='center'>
            <td>Bil</td>
            <td>Nama</td>
            <td>ID Pelajar</td>
            <td>Kelas</td>
            <td>Kehadiran</td>
        </tr>

        <?php
        $bil = 0;

        # syarat tambahan yang akan dimasukkan dalam arahan(query) senarai pelajar
        $tambahan = "";
        if (!empty($_POST['nama'])) {
            $nama = mysqli_real_escape_string($condb, $_POST['nama']);
            $tambahan = " AND pelajar.namapelajar LIKE '%$nama%'";
        }

        # arahan query untuk mencari senarai pelajar dengan kehadiran
        $arahan_papar = "SELECT pelajar.idpelajar, pelajar.namapelajar, kelas.kelas,
            (SELECT COUNT(*) FROM kelastambahan WHERE idpelajar = pelajar.idpelajar AND idsub = '$idsub') AS hadir
            FROM pelajar
            LEFT JOIN kelas ON pelajar.idkelas = kelas.idkelas
            LEFT JOIN kelastambahan ON pelajar.idpelajar = kelastambahan.idpelajar AND kelastambahan.idsub = '$idsub'
            WHERE 1=1 $tambahan
            GROUP BY pelajar.idpelajar
            ORDER BY pelajar.namapelajar";

        # laksanakan arahan mencari data pelajar
        $laksana = mysqli_query($condb, $arahan_papar);
        $hadir = $takhadir = $bil = 0;

        # Mengambil data yang ditemui
        while ($m = mysqli_fetch_array($laksana)) {
            # memaparkan senarai nama dalam jadual
            echo "<tr>
                <td align='center'>" . ++$bil . "</td>
                <td align='center'>" . $m['namapelajar'] . "</td>
                <td align='center'>" . $m['idpelajar'] . "</td>
                <td align='center'>" . $m['kelas'] . "</td>
                <td align='center'>";
            if ($m['hadir'] > 0) {
                echo "&#9989;";
            } else {
                echo "&#10060;";
            }
            echo "</td>
            </tr>";
        }
        echo "</table>";
    }
    ?>

<?php include('footer.php'); ?>
