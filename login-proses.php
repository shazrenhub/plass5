<?php
# Memulakan fungsi session
session_start();

# Menyemak kewujudan data post yang dihantar dari login-borang.php
if (!empty($_POST['idpelajar']) and !empty($_POST['katalaluan'])) {
    # memanggil fail connection.php
    include ('connection.php');
    
    # Mengambil data yang di POST dari fail Borang
    $idpelajar = $_POST['idpelajar'];
    $katalaluan = $_POST['katalaluan'];
    
    # Arahan SQL (query) untuk membandingkan data yang dimasukkan
    # wujud di pangkalan data atau tidak
    $query_login = "SELECT * FROM pelajar
                    WHERE
                        idpelajar = '$idpelajar'
                    AND
                        katalaluan = '$katalaluan' LIMIT 1";
    
    # melaksanakan arahan membandingkan data
    $laksana_query = mysqli_query($condb, $query_login);
    
    # jika terdapat 1 data yang sepadan, login berjaya
    if (mysqli_num_rows($laksana_query) == 1) {
        # mengambil data yang ditemui
        $m = mysqli_fetch_array($laksana_query);
        
        # mengumpukkan kepada pembolehubah session
        $_SESSION['idpelajar'] = $m['idpelajar'];
        $_SESSION['tahap'] = $m['tahap'];
        $_SESSION['namapelajar'] = $m['namapelajar'];
        
        # membuka laman index.php
        echo "<script>window.location.href='index.php';</script>";
    } else {
        # login gagal. kembali ke laman login-borang.php
        die("<script>alert('Login Gagal');
            window.location.href='login-borang.php';</script>");
    }
} else {
    # data yang dihantar dari laman login-borang.php kosong
    die("<script>alert('Sila masukkan id pelajar dan katalaluan');
        window.location.href='login-borang.php';</script>");
}
?>