<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
?>

<h3>Daftar Perjumpaan Baru</h3>
<!-- Borang untuk menerima data dari pengguna -->
<form action='aktiviti-daftar-proses.php' method='POST'>
    
	Subjek
    <input type='text' name='subjek' required><br>

    Tarikh
    <input type='date' name='tarikh' min='<?= date("Y-m-d") ?>' required><br>

    Masa Mula
    <input type='text' name='masa' required><br>

    <input type='submit' value='Daftar'>
</form>

<?php include('footer.php'); ?>
