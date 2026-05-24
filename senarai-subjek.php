<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan guard-aktiviti.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');
?>

<h3 align='center'>Senarai subjek</h3>

<!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
<table align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='#7B6464'>
        <td>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text' name='subjek' placeholder='Carian subjek'>
                <input type='submit' value='Cari'>
            </form>
        </td>
        <td colspan='2' align='right'>
            | <a href='aktiviti-daftar-borang.php'>Daftar Perjumpaan Subjek Baru </a> |
            <!-- Memanggil fail butang-saiz bagi membolehkan pengguna mengubah saiz tulisan -->
            <?php include('butang-saiz.php'); ?>
        </td>
    </tr>
    <tr bgcolor='#555555' align='center'>
        <td>Subjek</td>
        <td>Tarikh | Masa</td>
        <td>Tindakan</td>
    </tr>

    <?php
    # syarat tambahan yang akan dimasukkan dalam arahan(query) senarai subjek
    $tambahan = "";
    if (!empty($_POST['subjek'])) {
        $tambahan = "where subjek like '%" . $_POST['subjek'] . "%'";
    }
    # arahan query untuk mencari senarai subjek
    $arahan_papar = "select* from subjek $tambahan ";

    # laksanakan arahan mencari data subjek
    $laksana = mysqli_query($condb, $arahan_papar);

    # Mengambil data yang ditemui
    while ($m = mysqli_fetch_array($laksana)) {
        # memaparkan senarai nama dalam jadual
        echo "<tr>
            <td align='center'>" . $m['subjek'] . "</td>
            <td align='center'>" . $m['tarikh'] . " | " . $m['masa'] . " </td> ";

        # memaparkan navigasi untuk kemaskini dan hapus data subjek
        echo "<td align='center'>
            | <a href='aktiviti-kemaskini-borang.php?idsub=" . $m['idsub'] . "'>Kemaskini</a>
            | <a href='aktiviti-padam-proses.php?idsub=" . $m['idsub'] . "'
            onClick=\"return confirm('Anda pasti anda ingin memadam data ini?')\">Hapus</a>
            | <a href='kehadiran-borang.php?idsub=" . $m['idsub'] . "'>Pengesahan Kehadiran</a> |
            </td>
        </tr>";
    }
    ?>
</table>

<?php include ('footer.php'); ?>
