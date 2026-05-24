<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php
include('header.php');
?>
<style>
    #bannerImage {
        display: block;
        margin: 0 auto;
        width: 80%;
        height: 50%;
    }
</style>
<table width='100%'>
    <tr>
        <td width='70%' bgcolor='#cfceca'>
            <img id="bannerImage" src='img/bannerkucing.jpeg' width="100%" height="auto">
        </td>
        <td align='center' bgcolor='#555555'>
            <h3>Daftar Sebagai Murid</h3>
            <h3>Klik Pautan Dibawah untuk Mendaftar</h3>
            <a href='signup-borang.php'>Sign Up</a>
        </td>
    </tr>
</table>
<?php include ('footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bannerImages = ['img/bannerdenji(1).jpeg', 'img/bannerkucing.jpeg', 'img/bannertravis(1).jpeg'];
    const bannerImage = document.getElementById('bannerImage');
    let currentIndex = 0;

    function changeBannerImage() {
        bannerImage.src = bannerImages[currentIndex];
        currentIndex = (currentIndex + 1) % bannerImages.length;
    }

    setInterval(changeBannerImage, 3000);
});
</script>
