<?php
# memulakan fungsi session
session_start();

# memanggil fail luaran dan istihar pemboleh ubah
include('header.php');
include('kawalan-admin.php');
include('connection.php');
$masa = date("H:i:s");
$status = ""; # digunakan untuk memaparkan status kehadiran
$warna = "";  # digunakan untuk warna latar belakang status

# menyemak kewujudan data POST
if (!empty($_POST['idpelajar'])) {
    # menyemak adakah idpelajar yang dimasukkan telah wujud dalam pangkalan data
    $arahan_sql_semak = "SELECT * FROM pelajar WHERE idpelajar = '" . $_POST['idpelajar'] . "'";
    $laksana_arahan_semak = mysqli_query($condb, $arahan_sql_semak);

    if (mysqli_num_rows($laksana_arahan_semak) != 1) {
        # jika idpelajar yang dimasukkan telah wujud.
        $status = "ID Pelajar yang dimasukan/diimbas tiada dalam sistem";
        $warna = "red";
    } else {
        # Proses Menyemak idpelajar yang dimasukan telah merekodkan kehadiran atau tidak
        $arahan_semak = "SELECT * FROM kelastambahan WHERE idpelajar = '" . $_POST['idpelajar'] . "' AND idsub = '" . $_GET['idsub'] . "' LIMIT 1";
        $laksana_arahan = mysqli_query($condb, $arahan_semak);

        if (mysqli_num_rows($laksana_arahan) == 1) {
            $status = "Anda telah mengesahkan kehadiran sebelum ini.";
            $warna = "red";
        } else {
            # Proses Menyimpan data kehadiran
            $simpandata = mysqli_query($condb, "INSERT INTO kelastambahan (idpelajar, idsub, masahadir) VALUES ('" . $_POST['idpelajar'] . "','" . $_GET['idsub'] . "','$masa') ");

            # menyemak adakah proses menyimpan data berjaya
            if ($simpandata) {
                $status = "Kehadiran Telah Disahkan";
                $warna = "green";
            } else {
                $status = "Kehadiran Gagal direkodkan";
                $warna = "red";
            }
        }
    }
}

# Menyemak kewujudan data GET['idsub']
if (!empty($_GET['idsub'])) {
    # Proses mendapatkan data subjek
    $sql_aktiviti = "SELECT * FROM subjek WHERE idsub = '" . $_GET['idsub'] . "'";
    $laksana_aktiviti = mysqli_query($condb, $sql_aktiviti);
    $ma = mysqli_fetch_array($laksana_aktiviti);
}
?>

<h1 align='center'>Laman Rekod Kehadiran Kaunter Urusetia</h1>
<h3 align='center'>
    <!-- Borang Carian Subjek -->
    <form action='' method='GET'>
		Subjek <select name='idsub'>
			<option selected disabled value>Sila Pilih Subjek</option>

			<?php
			# Proses memaparkan senarai subjek dalam bentuk drop down list
			$arahan_sql_pilih = "SELECT * FROM subjek";
			$laksana_arahan_pilih = mysqli_query($condb, $arahan_sql_pilih);
			while ($n = mysqli_fetch_array($laksana_arahan_pilih)) {
				echo "<option value='" . $n['subjek'] . "'>" . $n['subjek'] . "</option>";
			}
			?>
		</select>
		<input type='submit' value='Cari'>
	</form>

    <?php if (!empty($_GET['idsub'])) { ?>
        <!-- Header bagi jadual untuk memaparkan senarai subjek -->
        <?= $ma['subjek'] ?><br>
        <?= $ma['tarikh'] ?> | <?= $ma['masa'] ?><br>
    </h3>

    <form align='center' action='' method='POST'>
        <label>Masukkan ID Pelajar anda di sini</label><br>
        <input type='text' name='idpelajar' autofocus autocomplete="off" required onblur="this.focus()"><br>
        <input type='submit' value='Rekod Kehadiran'>
    </form>

    <table width='50%' border='1' align='center'>
        <caption style="background-color:<?php echo $warna ?>"><h3><?= $status; ?></h3></caption>
        <tr bgcolor='#555555'>
            <td>#</td>
            <td>Nama</td>
            <td>ID Pelajar</td>
            <td>Masa Hadir</td>
        </tr>

        <?php
        $bil = 0;

        # Proses untuk memaparkan data kehadiran dalam bentuk jadual
        $arahan_sql_kehadiran = "SELECT * FROM pelajar, subjek, kelastambahan
        WHERE
            pelajar.idpelajar       = kelastambahan.idpelajar
            AND subjek.idsub     = kelastambahan.idsub
            AND kelastambahan.idsub = '" . $_GET['idsub'] . "'
            ORDER BY kelastambahan.masahadir DESC";

        $laksana_kehadiran = mysqli_query($condb, $arahan_sql_kehadiran);

        while ($m = mysqli_fetch_array($laksana_kehadiran)) {
            echo " <tr>
                    <td>" . ++$bil . "</td>
                    <td>" . $m['namapelajar'] . "</td>
                    <td>" . $m['idpelajar'] . "</td>
                    <td>" . $m['masahadir'] . "</td>
                </tr>";
        }
        ?>
    </table>
<?php } ?>

<?php include('footer.php'); ?>
