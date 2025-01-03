<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Digital UNTAN</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo">INFORMATICS</div>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="kontak.php">Kontak</a>
        </nav>
    </header>

    <nav class="main-nav">
        <div class="login-btn">
            <img src="assets/img/icon/user.png" alt="User">
            <?php 
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo $_SESSION['nama'];
                echo ' | <a href="logout.php" style="color: #1a237e; text-decoration: none;">Logout</a>';
            } else {
                echo '<a href="login.php" style="color: black; text-decoration: none;">Login</a>';
            }
            ?>
        </div>
        <div class="nav-links">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <a href="home.php" class="<?php echo ($current_page == 'home.php') ? 'active' : ''; ?>">Informasi</a>
            <a href="denah.php" class="<?php echo ($current_page == 'denah.php') ? 'active' : ''; ?>">Denah</a>
            <a href="vtour.php" class="<?php echo ($current_page == 'vtour.php') ? 'active' : ''; ?>">Virtual Tour</a>
            <a href="fasilitas.php" class="<?php echo ($current_page == 'fasilitas.php') ? 'active' : ''; ?>">Fasilitas</a>
            <a href="pelaporan.php" class="<?php echo ($current_page == 'pelaporan.php') ? 'active' : ''; ?>">Pelaporan</a>
            <a href="tentang.php" class="<?php echo ($current_page == 'tentang.php') ? 'active' : ''; ?>">Tentang</a>
            <a href="helpdesk.php" class="<?php echo ($current_page == 'helpdesk.php') ? 'active' : ''; ?>">Help Desk</a>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Denah Digital dan Monitoring Fasilitas Informatika, UNTAN</h1>
        </div>
        <div class="hero-image">
            <img src="assets/img/icon/maps.png" alt="Maps Icon">
        </div>
    </section>

    <h2 style="padding: 40px 40px 0; font-size: 1.8em;">Pilih kebutuhanmu . . .</h2>

    <div class="content-wrapper">
        <div class="menu-cards">
            <a href="denah.php" class="card-link">
                <div class="card">
                    <img src="assets/img/icon/denah.png" alt="Denah">
                    <h3>DENAH</h3>
                    <p>Jelajahi Fakultas Teknik secara mudah tanpa datang ke lokasi dengan denah dan fitur Virtual Tour
                        lengkap untuk Laboratorium Prodi Informatika!</p>
                </div>
            </a>
            <a href="fasilitas.php" class="card-link">
                <div class="card">
                    <img src="assets/img/icon/fasilitas.png" alt="Fasilitas">
                    <h3>FASILITAS</h3>
                    <p>Temukan daftar lengkap fasilitas di gedung dan ruangan Fakultas Teknik yang siap dukung kegiatanmu di
                        kampus!</p>
                </div>
            </a>
            <a href="pelaporan.php" class="card-link">
                <div class="card">
                    <img src="assets/img/icon/pelaporan.png" alt="Pelaporan">
                    <h3>PELAPORAN</h3>
                    <p>Bantu kami meningkatkan kenyamanan fasilitas yang ada dengan cara laporkan kerusakan atau kekurangan
                        dengan mudah disini!</p>
                </div>
            </a>
        </div>

        <div class="menu-cards">
            <div class="info-box">
                <div class="fakultas-info">
                    <p>FAKULTAS TEKNIK UNTAN terdiri atas</p>
                    <p>11 program studi untuk jenjang S1 dan</p>
                    <p>2 program studi untuk jenjang S2</p>
                </div>
                <div class="prodi-info">
                    <p>PRODI INFORMATIKA UNTAN didirikan</p>
                    <p>pada 18 Mei 2004, Akreditasi B menurut</p>
                    <p>1858/SK/BAN-PT/AK-PPJ/S/III/2022</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-left">
            <img src="assets/img/logo-if.png" alt="Logo Informatika">
        </div>
        <div class="footer-right">
            <p>TEKNIK INFORMATIKA UNIVERSITAS TANJUNGPURA 2024</p>
        </div>
    </footer>
</body>

</html>