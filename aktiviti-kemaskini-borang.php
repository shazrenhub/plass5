<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# Menyemak kewujudan data GET. Jika data GET empty, buka fail senarai-subjek
if (empty($_GET)) {
    die("<script>window.location.href='senarai-subjek.php';</script>");
}

# Mendapatkan maklumat subjek dari pangkalan data
$arahan_sql_pilih = "SELECT * FROM subjek WHERE idsub ='" . $_GET['idsub'] . "' ";
$laksana_arahan = mysqli_query($condb, $arahan_sql_pilih);
$m = mysqli_fetch_array($laksana_arahan);
?>

<h3>Kemaskini Perjumpaan Subjek Baru</h3>

<form action='aktiviti-kemaskini-proses.php?idsub=<?= $m['idsub'] ?>' method='POST'>

    Subjek
    <input type='text' name='subjek' value='<?= $m['subjek'] ?>' required><br>

    Tarikh
    <input type='date' name='tarikh' min='<?= date("Y-m-d") ?>' value='<?= $m['tarikh'] ?>' required><br>

    Masa Mula
    <input type='text' name='masa' value='<?= $m['masa'] ?>' required><br>

    <input type='submit' value='Kemaskini'>
</form>

<?php include('footer.php'); ?>
