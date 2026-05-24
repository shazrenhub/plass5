<!DOCTYPE html>
<html>
<title>Kelas Tambahan Tingkatan 5</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class='w3-container w3-black w3-center'>
	<h1>Kelas Tambahan Tingkatan 5</h1>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>

		<?php if (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "ADMIN") { ?>
			<!-- Menu admin: dipaparkan sekiranya admin telah login -->
			<a class='23-bar-item w3-button w3-pink' href='index.php'>Home</a>
			<a class='23-bar-item w3-button w3-pink' href='profil.php'>Profil</a>
			<a class='23-bar-item w3-button w3-pink' href='kehadiran-rekod.php'>Kaunter Kehadiran</a>
			<a class='23-bar-item w3-button w3-pink' href='senarai-murid.php'>Senarai murid</a>
			<a class='23-bar-item w3-button w3-pink' href='senarai-subjek.php'>Senarai subjek</a>
			<a class='23-bar-item w3-button w3-pink' href='kehadiran-laporan.php'>Laporan Kehadiran</a>
			<a class='23-bar-item w3-button w3-pink' href='logout.php'>Logout</a>
		<?php } else if (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "MURID") { ?>
			<!-- Menu murid: dipaparkan sekiranya murid telah login -->
			<a class='23-bar-item w3-button w3-pink' href='index.php'>Home</a>
			<a class='23-bar-item w3-button w3-pink' href='profil.php'>Profil</a>
			<a class='23-bar-item w3-button w3-pink' href='logout.php'>Logout</a>
		<?php } else { ?>
			<!-- Menu Laman Utama: dipaparkan sekiranya admin atau murid tidak login -->
			<a class='23-bar-item w3-button w3-pink' href='index.php'>Home</a>
			<a class='23-bar-item w3-button w3-pink'href='login-borang.php'>Log In</a>
		<?php } ?>
</div>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  
</div>



<div class="w3-container">

Isi kandungan

</div>

</div>

<div class='w3-container w3-teal'>
	<h5> Hak Cipta terpelihara </h5>
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>
