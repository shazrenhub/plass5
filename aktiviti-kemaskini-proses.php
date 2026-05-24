<?php
# Memulakan fungsi session
session_start();

# Memanggil fail kawalan-admin.php
include('kawalan-admin.php');

# Menyemak kewujudan data POST
if (!empty($_POST)) {
    # Memanggil fail connection.php
    include('connection.php');

    # Arahan SQL (query) untuk kemaskini maklumat subjek
    $arahan = "UPDATE subjek SET
        subjek = '" . $_POST['subjek'] . "',
        tarikh = '" . $_POST['tarikh'] . "',
        masa = '" . $_POST['masa'] . "'
        WHERE idsub = '" . $_GET['idsub'] . "'";

    # Melaksana dan menyemak proses kemaskini
    if (mysqli_query($condb, $arahan)) {
        # Kemaskini berjaya
        echo "<script>alert('Kemaskini Berjaya'); window.location.href='senarai-subjek.php';</script>";
    } else {
        # Kemaskini gagal
        echo "<script>alert('Kemaskini Gagal'); window.history.back();</script>";
    }
} else {
    # Jika data GET tidak wujud, kembali ke fail senarai-subjek.php
    die("<script>alert('Sila lengkapkan data'); window.location.href='senarai-subjek.php';</script>");
}
?>
