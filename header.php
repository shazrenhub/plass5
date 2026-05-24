<!DOCTYPE html>
<html>
<head>
    <title>Kelas Tambahan Tingkatan 5</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #7B6464;
            transition: filter 0.3s ease-in-out;
        }

        header {
            background-color: #CFCECA;
            color: #404040;
        }

        footer {
            background-color: #CFCECA;
            color: #404040;
            padding: 10px;
        }

        article {
            padding: 9px;
            text-align: center;
        }

        h3 {
            color: #cfceca;
        }

        table {
            background-color: #AC8181;
            width: 100%;
            border-collapse: collapse;
            border: 3px outset grey;
        }

        td {
            padding: 10px;
        }

        tr:hover {
            background-color: #555555;
        }

        nav {
            background-color: #828181;
            padding: 5px;
        }

        a {
            background-color: #494949;
            color: #D3D3D3;
            padding: 3px 3px;
            text-decoration: none;
            display: inline-block;
            border-radius: 20px;
        }

        a:hover {
            background-color: #555555;
        }

        input,
        select,
        button {
            padding: 3px;
            margin-top: 5px;
            border-radius: 20px;
        }

        input[type=submit] {
            background-color: #828181;
            color: #D3D3D3;
        }

        input[type=submit]:hover {
            background-color: #828181;
            color: #555555;
        }

        .respon {
            max-width: 100%;
            height: 50%;
        }

        .user-info {
            text-align: center;
            padding: 10px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<header>
    <hr>
    <footer style="text-align:center;">
        <h1>KELAS TAMBAHAN TINGKATAN 5</h1>
        <p>Sistem Pengesahan Kehadiran Murid</p>
        <img class='respon' src='img/bannerbuku.jpg' style='width: 30%; height: 50%;'>
    </footer>
</header>

<nav>
    <?php if (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "ADMIN") { ?>
        | <a href='index.php'>🏠︎</a>
        | <a href='profil.php'>Profil</a>
        | <a href='kehadiran-rekod.php'>Kaunter Kehadiran</a>
        | <a href='senarai-murid.php'>Senarai murid</a>
        | <a href='senarai-subjek.php'>Senarai subjek</a>
        | <a href='kehadiran-laporan.php'>Laporan Kehadiran</a>
        | <a href='logout.php'>Logout</a>
        | <hr>
    <?php } else if (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "MURID") { ?>
        | <a href='index.php'>🏠︎</a>
        | <a href='profil.php'>Profil</a>
        | <a href='logout.php'>Logout</a>
        | <hr>
    <?php } else { ?>
        | <a href='index.php'>🏠︎</a>
        | <a href='login-borang.php'>Log In</a>
        <hr>
    <?php } ?>
</nav>

<article>
    <div class="user-info">
        <?php
        if (!empty($_SESSION['namapelajar'])) {
            echo "Logged in as: " . $_SESSION['namapelajar'];
        } else {
            echo "No user logged in";
        }
        ?>
    </div>

    <div class="container" style="text-align: left;">
        <div class="controls">
            <label for="brightnessRange">☀</label>
            <input type="range" id="brightnessRange" min="50" max="150" value="100">
        </div>
    </div>
</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brightnessRange = document.getElementById('brightnessRange');

    function changeBrightness() {
        const brightnessValue = brightnessRange.value;
        const filterValue = `brightness(${brightnessValue}%)`;
        document.body.style.filter = filterValue;

        localStorage.setItem('brightnessValue', brightnessValue);
    }

    brightnessRange.addEventListener('input', changeBrightness);

    const storedBrightness = localStorage.getItem('brightnessValue');
    if (storedBrightness !== null) {
        brightnessRange.value = storedBrightness;
        changeBrightness();
    }
});
</script>

</body>
</html>
