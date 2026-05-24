<?php
# memulakan fungsi SESSION
session_start();

# memanggil fail header.php & fail connection.php
include('header.php');
include('connection.php');
?>

<!-- Tajuk antaramuka-->
<h3> Pendaftaran Murid </h3>

<!-- Borang Pendaftaran Murid-->
<form action = 'signup-proses.php' method = 'POST'>

	Nama Murid		<input type ='text'		name ='namapelajar'		required placeholder='Sila masukkan nama'> <br>
	ID Pelajar		<input type ='text'		name ='idpelajar'	required placeholder='Sila masukkan IDPelajar'> <br>
	Tingkatan		<select name='idkelas'><br>
					<option selected disabled value>Sila Pilih Kelas</option>
					<?php
					# Proses memaparkan senarai kelas dalam bentuk drop down list
					$arahan_sql_pilih		=	"select* from kelas";
					$laksana_arahan_pilih	=	mysqli_query($condb,$arahan_sql_pilih);
					while($m=mysqli_fetch_array($laksana_arahan_pilih))
					{
						echo "<option value='".$m['idkelas']."'>
						".$m['ting']." ".$m['kelas']."
						</option>";
					}
					?>
					 </select> <br>
	Katalaluan		 <input type ='password'	name='katalaluan'	required placeholder='Sila masukkan katalaluan'> <br>
					 <input type ='submit'		value='Daftar'>
</form>
<?php include ('footer.php');?>
