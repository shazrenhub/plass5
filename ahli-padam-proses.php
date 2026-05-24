<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('kawalan-admin.php');

# menyemak kewujudan data GET idpelajar pelajar
if (!empty($_GET)) {
    # memanggil fail connection
    include('connection.php');

    # arahan SQL untuk memadam data pelajar berdasarkan idpelajar yang dihantar
    $arahan = "DELETE FROM pelajar WHERE idpelajar ='".$_GET['idpelajar']."'";

    # melaksanakan arahan SQL padam data dan menguji proses padam data
    if (mysqli_query($condb, $arahan)) {
        # jika data berjaya dipadam
        echo "<script>alert('Padam data Berjaya');
		window.location.href='senarai-murid.php';</script>";
    } else {
        # jika data gagal dipadam
        echo "<script>alert('Padam data Gagal');
		window.location.href='senarai-murid.php';</script>";
    }
} else {
    # jika data GET tidak wujud (empty)
    die("<script>alert('Ralat! Akses secara terus');
	window.location.href='senarai-murid.php';</script>");
}
?>
