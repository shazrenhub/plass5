<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('kawalan-admin.php');

# menyemak kewujudan data POST
if (!empty($_POST)) {
    # memanggil fail connection.php
    include('connection.php');

    # pengesahan data (validation) idpelajar pelajar
    if (strlen($_POST['idpelajar']) != 3 or !is_numeric($_POST['idpelajar'])) {
        die("<script>alert('Ralat IDPelajar');window.history.back();</script>");
    }

    # arahan SQL (query) untuk kemaskini maklumat pelajar
    $arahan = "update pelajar set
                namapelajar = '" . $_POST['namapelajar'] . "',
                idpelajar = '" . $_POST['idpelajar'] . "',
                katalaluan = '" . $_POST['katalaluan'] . "',
                idkelas = '" . $_POST['idkelas'] . "',
                tahap = '" . $_POST['tahap'] . "'
                where idpelajar = '" . $_GET['idpelajar_lama'] . "'";

    # melaksana dan menyemak proses kemaskini
    if (mysqli_query($condb, $arahan)) {
        # kemaskini berjaya
        echo "<script>alert('Kemaskini Berjaya');
		window.location.href='senarai-murid.php';</script>";
    } else {
        # kemaskini gagal
        echo "<script>alert('Kemaskini Gagal');
		window.history.back();</script>";
    }
} else {
    # jika data GET tidak wujud. kembali ke fail senarai-ahli.php
    die("<script>alert('Sila lengkapkan data');
	window.location.href='senarai-murid.php';</script>");
}
?>
