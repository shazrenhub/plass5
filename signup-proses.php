<?php
# memulakan fungsi SESSION
session_start();

# menyemak kewujudan data post
if (!empty($_POST)) {
    # Memanggil fail connection.php
    include('connection.php');

    # mengambil data yang dihantar dari fail signup-borang.php
    $namapelajar      = $_POST['namapelajar'];
    $idpelajar	= $_POST['idpelajar'];
    $idkelas   = $_POST['idkelas'];
    $katalaluan = $_POST['katalaluan'];

    # data validation : had atas had bawah
    # idpelajar yang dimasukkan hendaklah 12 digit dan tidak mempunyai huruf atau simbol
	if (strlen($idpelajar) != 3 || !is_numeric($idpelajar)) {
        die("<script>alert ('Ralat Pada No Kad Pengenalan')
		window.location.href='signup-borang.php'; </script>");
    }

    # menyemak adakah id_pelajar yang dimasukkan telah wujud dalam pangkalan data
    $arahan_sql_semak        = "SELECT * FROM pelajar WHERE idpelajar='$idpelajar' LIMIT 1";
    $laksana_arahan_semak    = mysqli_query($condb, $arahan_sql_semak);
    if (mysqli_num_rows($laksana_arahan_semak) == 1) {
        # jika idpelajar yang dimasukkan telah wujud. aturcara akan dihentikan.
        die("<script>alert ('RALAT idpelajar. idpelajar yang dimasukkan telah digunakan');
		window.location.href='signup-borang.php'; </script>");
    }

    # arahan SQL (query) untuk menyimpan data pelajar baru
    $arahan_sql_simpan = "INSERT INTO pelajar
		(namapelajar,idpelajar,idkelas,katalaluan, tahap)
		VALUES
		('$namapelajar', '$idpelajar', '$idkelas' ,'$katalaluan', 'MURID') ";


    # Melaksanakan arahan SQL menyimpan data murid baru
    $laksana_arahan_simpan = mysqli_query($condb, $arahan_sql_simpan);

    # menguji jika proses menyimpan data berjaya atau tidak
    if ($laksana_arahan_simpan) {
        # jika data berjaya disimpan. papar popup dan buka fail ahli-login-borang
        echo "<script>alert('Pendaftaran Berjaya. Sila Login Masuk');
		window.location.href='login-borang.php'; </script>";
    } else {
        # jika data tidak berjaya disimpan. Papar popup dan buka fail signup-borang
        echo "<script>alert('Pendaftaran Gagal');
		window.location.href='signup-borang.php'; </script>";
    }
} else {
    # jika pengguna buka fail ini tanpa mengisi data.
    # papar popup dan buka fail signup-borang.php
    echo "<script>alert('Sila lengkapkan maklumat');
	window.location.href='signup-borang.php'; </script>";
}
?>
