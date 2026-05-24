<?php
# Menyemak nilai pembolehubah session['tahap']
if(!empty($_SESSION['tahap'])){
	if($_SESSION['tahap'] != "MURID")
	{
		# jika nilainya tidak sama dengan MURID. aturcara akan dihentikan
		die("<script>alert('sila login');
		window.location.href='logout.php');</script>");
	}
}else{
	# jika nilai session empty.
	die("<script>alert('sila login');
	window.location.href='logout.php';</script>");
}
?>
