<?php
session_start();
require_once 'config/koneksi.php';

// Redirect ke halaman login jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari session
$nama = $_SESSION['nama'];
$email = $_SESSION['username'];

// Ambil data ruangan dari database
$query = "SELECT ruangan FROM fasilitas";
$result = mysqli_query($koneksi, $query);
$ruanganOptions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $ruanganOptions[] = $row['ruangan'];
}

// Ambil data perlengkapan dari database
$perlengkapanOptions = ['Kursi dan Meja', 'Papan Tulis', 'Spidol', 'Penghapus', 'LCD', 'Kipas', 'AC', 'Lainnya'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelaporan</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <a href="home.php">Informasi</a>
            <a href="denah.php">Denah</a>
            <a href="vtour.php">Virtual Tour</a>
            <a href="fasilitas.php">Fasilitas</a>
            <a href="pelaporan.php" class="active">Pelaporan</a>
            <a href="tentang.php">Tentang</a>
            <a href="helpdesk.php">Help Desk</a>
        </div>
    </nav>

    <div class="form-container">
        <h1>FORM PELAPORAN</h1>
        <form action="submit_pelaporan.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" readonly>

            <label for="email">E-Mail</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>

            <label for="fasilitas">Ruangan</label>
            <select id="fasilitas" name="fasilitas" required>
                <option value="">Pilih Ruangan</option>
                <?php foreach ($ruanganOptions as $ruangan): ?>
                    <option value="<?php echo htmlspecialchars($ruangan); ?>"><?php echo htmlspecialchars($ruangan); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="perlengkapan">Perlengkapan</label>
            <select id="perlengkapan" name="perlengkapan" required>
                <option value="">Pilih Perlengkapan</option>
                <?php foreach ($perlengkapanOptions as $perlengkapan): ?>
                    <option value="<?php echo htmlspecialchars($perlengkapan); ?>"><?php echo htmlspecialchars($perlengkapan); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="deskripsi">Deskripsi Masalah</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea>

            <label for="bukti">Bukti</label>
            <input type="file" id="bukti" name="bukti" accept="image/*">
            <br><br>
            <button type="submit">Kirim</button>
        </form>
    </div>

    <script>
    function validateForm() {
        var deskripsi = document.getElementById('deskripsi').value;
        var fasilitas = document.getElementById('fasilitas').value;
        var perlengkapan = document.getElementById('perlengkapan').value;

        if (!fasilitas) {
            alert('Silakan pilih ruangan!');
            return false;
        }
        if (!perlengkapan) {
            alert('Silakan pilih perlengkapan!');
            return false;
        }
        if (!deskripsi.trim()) {
            alert('Silakan isi deskripsi masalah!');
            return false;
        }
        return true;
    }
    </script>

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