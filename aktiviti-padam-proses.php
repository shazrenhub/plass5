<?php
# Memulakan fungsi session
session_start();

# Memanggil fail kawalan-admin.php
include('kawalan-admin.php');

# Menyemak kewujudan data GET idsub subjek
if (!empty($_GET)) {
    # Memanggil fail connection
    include('connection.php');

    # Arahan SQL untuk memadam data subjek berdasarkan idsub yang dihantar
    $arahan = "DELETE FROM subjek WHERE
        idsub = '" . $_GET['idsub'] . "'";

    # Melaksanakan arahan SQL padam data dan menguji proses padam data
    if (mysqli_query($condb, $arahan)) {
        # Jika data berjaya dipadam
        echo "<script>alert('Padam data Berjaya'); window.location.href='senarai-subjek.php';</script>";
    } else {
        # Jika data gagal dipadam
        echo "<script>alert('Padam data gagal'); window.location.href='senarai-subjek.php';</script>";
    }
} else {
    # Jika data GET tidak wujud (empty)
    die("<script>alert('Ralat! Akses secara terus'); window.location.href='senarai-subjek.php';</script>");
}
?>
