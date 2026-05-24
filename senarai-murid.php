<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');
?>
<!-- Header bagi jadual untuk memaparkan senarai pelajar -->
<h3 align='center'>Senarai Murid</h3>

<table align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='#7B6464'>
        <td colspan='3'>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text' name='namapelajar' placeholder='Carian Nama Murid'>
                <input type='submit' value='Cari'>
            </form>
        </td>
        <td colspan='3' align='right'>
            | <a href='upload.php'>Muat Naik Murid</a> |
            <?php include('butang-saiz.php'); ?>
        </td>
    </tr>
    <tr bgcolor='#555555'>
        <td width='35%'>Nama</td>
        <td width='15%'>IdPelajar</td>
        <td width='10%'>Kelas</td>
        <td width='10%'>Katalaluan</td>
        <td width='10%'>Tahap</td>
        <td width='20%'>Tindakan</td>
    </tr>
<?php
# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai ahli
$tambahan = "";
if (!empty($_POST['namapelajar'])) {
    $tambahan = " and pelajar.namapelajar like '%" . $_POST['namapelajar'] . "%'";
}
# arahan query untuk mencari senarai nama pelajar
$arahan_papar = "select * from pelajar, kelas where pelajar.idkelas = kelas.idkelas $tambahan";
# laksanakan arahan mencari data pelajar
$laksana = mysqli_query($condb, $arahan_papar);
# Mengambil data yang ditemui
while ($m = mysqli_fetch_array($laksana)) {
    # umpukkan data kepada tatasusunan bagi tujuan kemaskini pelajar
    $data_get = array(
        'namapelajar' => $m['namapelajar'],
        'idpelajar' => $m['idpelajar'],
        'katalaluan' => $m['katalaluan'],
        'tahap' => $m['tahap'],
        'idkelas' => $m['idkelas'],
        'kelas' => $m['kelas']
    );

    # memaparkan senarai nama dalam jadual
    echo "<tr>
        <td align='center'>" . $m['namapelajar'] . "</td>
        <td align='center'>" . $m['idpelajar'] . "</td>
        <td align='center'>" . $m['kelas'] . "</td>
        <td align='center'>" . $m['katalaluan'] . "</td>
        <td align='center'>" . $m['tahap'] . "</td>";

    # memaparkan navigasi untuk kemaskini dan hapus data ahli
    echo "<td align='center'>
        |<a href='ahli-kemaskini-borang.php?" . http_build_query($data_get) . "'>Kemaskini</a>
        |<a href='ahli-padam-proses.php?idpelajar=" . $m['idpelajar'] . "' onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">Hapus</a>|
        </td>
    </tr>";
}
?>
</table>
<?php include('footer.php'); ?>
