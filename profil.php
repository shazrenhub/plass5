<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');

# Menyemak kewujudan nilai pembolehubah session['idpelajar']
if (empty($_SESSION['idpelajar'])) {
    # jika nilai session nokp tidak wujud/kosong. aturcara akan dihentikan
    die("<script>alert('Sila login'); window.location.href='logout.php';</script>");
}
?>

<table width='100%' bgcolor='#555555' border='1'>
    <tr>
        <td width='70%' align='center' valign='top'>
            <h3>Rekod Kehadiran</h3>

            <!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
            <table align='center' width='100%' border='1' id='saiz' bgcolor='white'>
                <caption>
                    Pengesahan Kendiri hanya boleh dilakukan pada subjek dilaksana sahaja
                </caption>
                <tr align='center' bgcolor='#555555'>
                    <td>Subjek</td>
                    <td>Tarikh | Masa</td>
                    <td>Kehadiran</td>
                </tr>
                <?php

                # arahan query untuk mencari senarai subjek
                $arahan_papar = "SELECT * FROM subjek";

                # laksanakan arahan mencari data subjek
                $laksana = mysqli_query($condb, $arahan_papar);

                # Mengambil data yang ditemui
                while ($m = mysqli_fetch_array($laksana)) {
                    # memaparkan senarai nama dalam jadual
                    echo "<tr>
                        <td align='center'>" . $m['subjek'] . "</td>
                        <td align='center'>" . $m['tarikh'] . " | " . $m['masa'] . "</td>
                        <td align='center'>";

                    # Arahan mendapatkan data kehadiran ahli bagi setiap subjek
                    $arahan_sql_hadir = "SELECT * FROM kelastambahan WHERE
                        idpelajar='" . $_SESSION['idpelajar'] . "' AND idsub='" . $m['idsub'] . "'";

                    # melaksanakan arahan sql mendapatkan data
                    $laksana_hadir = mysqli_query($condb, $arahan_sql_hadir);

                    if (mysqli_num_rows($laksana_hadir) == 1) {
                        echo "&#9989;";
                    } else {
                        echo "&#10060; <br>";

                        if (date("Y-m-d") == $m['tarikh']) {
                            # Pengesahan Kehadiran Kendiri
                            echo "<a href='profil-sahkendiri.php?idsub=" . $m['idsub'] . "'> [ PENGESAHAN KENDIRI ] </a>";
                        }
                    }
                    echo "</td></tr>";
                } ?>
            </table>
        </td>
    </tr>
</table>
<?php include('footer.php'); ?>
