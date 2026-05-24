<?php
# Memanggil fail connection.php
include('connection.php');

# Memadam data kehadiran lama agar dapat memasukkan data kehadiran baru
$sqlpadam = mysqli_query($condb, "DELETE FROM kelastambahan WHERE idsub='" . $_GET['idsub'] . "'");

$masa = date("H:i:s");

foreach ($_POST['kelastambahan'] as $idpelajar) {
    # Menyimpan semula data kehadiran yang baru
    $simpandata = mysqli_query($condb, "INSERT INTO kelastambahan
        (idpelajar idsub, masa)
        VALUES ('$idpelajar', '" . $_GET['idsub'] . "', '$masa')");
}

echo "<script>alert('Kemaskini Kehadiran Selesai');
    window.location.href='kehadiran-borang.php?idsub=" . $_GET['idsub'] . "';</script>";
?>
