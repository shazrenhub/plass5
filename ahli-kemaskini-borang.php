<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# Menyemak kewujudan data GET. Jika data GET empty, buka fail senarai-murid
if (empty($_GET)) {
    die("<script>window.location.href='senarai-murid.php';</script>");
}
?>

<h3>Kemaskini Murid Baru</h3>
<form action='ahli-kemaskini-proses.php?idpelajar_lama=<?= $_GET['idpelajar'] ?>' method='POST'>
    Nama
    <input type='text' name='namapelajar' value='<?= $_GET['namapelajar'] ?>' required><br>

    ID Pelajar
    <input type='text' name='idpelajar' value='<?= $_GET['idpelajar'] ?>' required><br>

    Kata Laluan
    <input type='text' name='katalaluan' value='<?= $_GET['katalaluan'] ?>' required><br>

    Tahap
    <select name='tahap'><br>
        <option value='<?= $_GET['tahap'] ?>'> <?= $_GET['tahap'] ?> </option>
        <?php
        # Proses memaparkan senarai tahap dalam bentuk drop down list
        $arahan_sql_tahap = "select tahap from ahli group by tahap order by tahap";
        $laksana_arahan_tahap = mysqli_query($condb, $arahan_sql_tahap);
        while ($n = mysqli_fetch_array($laksana_arahan_tahap)) {
            if ($n['tahap'] != $_GET['tahap']) {
                echo "<option value='" . $n['tahap'] . "'> " . $n['tahap'] . " </option>";
            }
        }
        ?>
    </select> <br>

    Tingkatan
    <select name='idkelas'><br>
        <option value='<?= $_GET['idkelas'] ?>'>
            <?= $_GET['ting'] . " " . $_GET['kelas'] ?>
        </option>
        <?php
        # Proses memaparkan senarai kelas dalam bentuk drop down list
        $arahan_sql_pilih = "select* from kelas";
        $laksana_arahan_pilih = mysqli_query($condb, $arahan_sql_pilih);
        while ($m = mysqli_fetch_array($laksana_arahan_pilih)) {
            if ($m['idkelas'] != $_GET['idkelas']) {
                echo "<option value='" . $m['idkelas'] . "'> " . $m['ting'] . " " . $m['kelas'] . " </option>";
            }
        }
        ?>
    </select> <br>

    <input type='submit' value='Kemaskini'>
</form>
<?php include('footer.php'); ?>
