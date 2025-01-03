<?php
session_start();
require_once 'config/koneksi.php';

// Query untuk mengambil data pelaporan dan menggabungkannya dengan tabel fasilitas
$query = "SELECT p.*, f.ruangan 
          FROM pelaporan p 
          JOIN fasilitas f ON p.fasilitas_id = f.id 
          ORDER BY p.created_at DESC";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk mengelompokkan laporan
$laporan_terkirim = [];
$laporan_diproses = [];
$laporan_selesai = [];

// Kelompokkan laporan berdasarkan status
while ($row = mysqli_fetch_assoc($result)) {
    $laporan = [
        'text' => $row['deskripsi_masalah'] . ', ' . $row['ruangan'],
        'date' => date('d F Y', strtotime($row['created_at']))
    ];

    if ($row['proses'] == 'selesai') {
        $laporan_selesai[] = $laporan;
    } elseif ($row['proses'] == 'diproses') {
        $laporan_diproses[] = $laporan;
    } else {
        $laporan_terkirim[] = $laporan;
    }
}
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
            if (isset($_SESSION['nama'])) {
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

    <div class="pelaporan-container">
    <h1>DAFTAR PELAPORAN</h1>
    
    <div class="pelaporan-content">
        <!-- Laporan Terkirim -->
        <div class="section-wrapper">
            <div class="section-header">
                <h2></h2>
                <button class="btn-tambah" onclick="window.location.href='form_pelaporan.php'">+ Tambah</button>
            </div>
            <div class="laporan-list">
                <?php if (empty($laporan_terkirim)): ?>
                    <div class="laporan-item cyan">
                        <div class="laporan-text">Tidak ada laporan terkirim</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($laporan_terkirim as $laporan): ?>
                        <div class="laporan-item cyan">
                            <div class="laporan-text"><?php echo htmlspecialchars($laporan['text']); ?></div>
                            <div class="laporan-date"><?php echo htmlspecialchars($laporan['date']); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Laporan Diproses -->
        <div class="section-wrapper">
            <div class="section-header">
                <h2>Telah Diproses</h2>
            </div>
            <div class="laporan-list">
                <?php if (empty($laporan_diproses)): ?>
                    <div class="laporan-item orange">
                        <div class="laporan-text">Tidak ada laporan diproses</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($laporan_diproses as $laporan): ?>
                        <div class="laporan-item orange">
                            <div class="laporan-text"><?php echo htmlspecialchars($laporan['text']); ?></div>
                            <div class="laporan-date"><?php echo htmlspecialchars($laporan['date']); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Laporan Selesai -->
        <div class="section-wrapper">
            <div class="section-header">
                <h2>Telah Selesai</h2>
            </div>
            <div class="laporan-list">
                <?php if (empty($laporan_selesai)): ?>
                    <div class="laporan-item green">
                        <div class="laporan-text">Tidak ada laporan selesai</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($laporan_selesai as $laporan): ?>
                        <div class="laporan-item green">
                            <div class="laporan-text"><?php echo htmlspecialchars($laporan['text']); ?></div>
                            <div class="laporan-date"><?php echo htmlspecialchars($laporan['date']); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['pesan'])): ?>
    <div class="alert alert-success">
        <?php 
        echo $_SESSION['pesan'];
        unset($_SESSION['pesan']);
        ?>
    </div>
<?php endif; ?>

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