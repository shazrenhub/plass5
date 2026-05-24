<?php
# Memulakan fungsi session
session_start();

# memanggil fail header.php
include('header.php');
?>

<!-- Tajuk antaramuka log masuk -->
<h3>Login Murid</h3>

<!-- borang daftar masuk (log in/sign in) -->
<form action='login-proses.php' method='POST'>

	IDpelajar		<input type='text'		name='idpelajar' required placeholder='Sila masukkan IDPelajar'><br>
	Katalaluan		<input type='password'	name='katalaluan' required placeholder='Sila masukkan katalaluan'><br>
					<input type='submit'	value='login'>
</form>
<?php include ('footer.php'); ?>
