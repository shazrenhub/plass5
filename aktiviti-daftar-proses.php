<?php
# Memulakan fungsi SESSION
session_start();

# Menyemak kewujudan data POST
if (!empty($_POST)) {
    include('connection.php');

    # Arahan SQL (query) untuk menyimpan data subjek baru
    $arahan_sql_simpan = "INSERT INTO subjek
        (subjek, tarikh, masa)
        VALUES
        ('" . $_POST['subjek'] . "', '" . $_POST['tarikh'] . "', '" . $_POST['masa'] . "')";

    # Melaksanakan arahan SQL menyimpan data subjek baru
    $laksana_arahan_simpan = mysqli_query($condb, $arahan_sql_simpan);

    # Menguji jika proses menyimpan data berjaya atau tidak
    if ($laksana_arahan_simpan) {
        # Jika data berjaya disimpan, papar popup dan buka fail senarai-subjek.php
        echo "<script>alert('Pendaftaran Aktiviti Berjaya.'); window.location.href='senarai-subjek.php'; </script>";
    } else {
        # Jika data tidak berjaya disimpan, papar popup dan buka fail aktiviti-daftar-borang.php
        echo "<script>alert('Pendaftaran Gagal'); window.location.href='aktiviti-daftar-borang.php'; </script>";
    }
} else {
    # Jika pengguna buka fail ini tanpa mengisi data.
    # Papar popup dan buka fail aktiviti-daftar-borang.php
    echo "<script>alert('Sila lengkapkan maklumat'); window.location.href='aktiviti-daftar-borang.php'; </script>";
}
?>
