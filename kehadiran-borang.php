<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php, connection.php dan guard-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

# Mendapatkan maklumat subjek dari pangkalan data
$arahan_sql_aktiviti = "SELECT * FROM subjek WHERE idsub ='".$_GET['idsub']."' ";
$laksana_aktiviti = mysqli_query($condb, $arahan_sql_aktiviti);
$n = mysqli_fetch_array($laksana_aktiviti);
?>

<h3>Pengesahan Kehadiran Ahli</h3>

Subjek : <?= $n['subjek'] ?> <br>
Tarikh | Masa : <?= $n['tarikh']." | ".$n['masa'] ?><br>
<br><br>

<?php include('butang-saiz.php'); ?>

<form action='kehadiran-proses.php?idsub=<?= $_GET['idsub'] ?>' method='POST'>
    <table border='1' id='saiz' width='100%'>
        <tr>
            <td>Bil</td>
            <td>Nama</td>
            <td>ID Pelajar</td>
            <td>Kelas</td>
            <td>Kehadiran</td>
        </tr>

        <?php
        # Arahan untuk mendapatkan data kehadiran setiap murid
        $arahan_sql_kehadiran = "SELECT
        pelajar.idpelajar, pelajar.namapelajar,
        kelas.kelas,
        kelastambahan.idsub
        FROM pelajar
        LEFT JOIN kelas
        ON pelajar.idkelas = kelas.idkelas
        LEFT JOIN kelastambahan
        ON pelajar.idpelajar = kelastambahan.idpelajar
        AND kelastambahan.idsub='".$_GET['idsub']."'
        ORDER BY pelajar.namapelajar";

        # Laksanakan arahan untuk memproses data
        $laksana_kehadiran = mysqli_query($condb, $arahan_sql_kehadiran);
        $bil = 0;

        # Mengambil dan memaparkan semua data kehadiran yang ditemui
        while ($m = mysqli_fetch_array($laksana_kehadiran)) { ?>
            <tr>
                <td><?= ++$bil; ?></td>
                <td><?= $m['namapelajar'] ?></td>
                <td><?= $m['idpelajar'] ?></td>
                <td><?= $m['kelas'] ?> </td>
                <td>
                    <?php
                    if ($m['idsub'] != null) {
                        $tanda = 'checked';
                    } else {
                        $tanda = '';
                    }
                    ?>
                    <input <?= $tanda ?> type='checkbox' name='kehadiran[]'
                        value='<?= $m['idpelajar'] ?> ' style='width:30px; height:30px;'>
                </td>
            </tr>
        <?php } ?>

        <tr>
            <td colspan='4'></td>
            <td><input type='submit' value='Simpan'></td>
        </tr>
    </table>
</form>

<?php include('footer.php'); ?>
