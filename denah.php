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
            if(isset($_SESSION['nama'])) {
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

    <div class="denah-container">
        <div class="denah-title">
            <h1>DENAH FAKULTAS TEKNIK</h1>
            <h2>UNIVERSITAS TANJUNGPURA</h2>
        </div>

        <div class="denah-image-container">
            <img src="assets/img/denahteknik.png" alt="Denah Fakultas Teknik" class="denah-image">
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