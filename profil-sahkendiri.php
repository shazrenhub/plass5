<?php
session_start();
# Memanggil fail connection dan kawalan-biasa
include('connection.php');

$masa = date("H:i:s");

# Menyemak kewujudan data GET id_aktiviti
if (!empty($_GET['idsub']) and !empty($_SESSION['idpelajar'])) {
    # Arahan Simpan kehadiran
    $sql = "INSERT INTO kelastambahan (idsub, idpelajar, masahadir)
            VALUES ('" . $_GET['idsub'] . "', '" . $_SESSION['idpelajar'] . "', '$masamula') ";

    # Laksana arahan Simpan
    $simpandata = mysqli_query($condb, $sql);

    # Menguji proses simpan
    if ($simpandata) {
        echo "<script>
                alert('Kehadiran Telah Disahkan');
                window.location.href='profil.php';
              </script>";
    } else {
        echo "<script>
                alert('Kehadiran GAGAL Disahkan. Sila Ke Meja Urusetia');
                window.location.href='profil.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Akses secara terus');
            window.location.href='logout.php';
          </script>";
}
?>
