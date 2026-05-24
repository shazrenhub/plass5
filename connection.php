<?php

#nama host
$nama_host= "localhost";

#username bagi sql
$nama_sql= "root";

#password bagi sql
$pass_sql= "";

#nama pangkalan data
$nama_db= "plass5";

#membuka hubungan antara pangkalan data dan sistem
$condb= mysqli_connect($nama_host, $nama_sql, $pass_sql, $nama_db);

#menguji sambungan berjaya atau tidak berjaya
if(!$condb)
{
	die("Sambungan ke pangkalan data gagal");
}
else
{
	#echo "Sambungan ke pangkalan data berjaya";
}
?>
