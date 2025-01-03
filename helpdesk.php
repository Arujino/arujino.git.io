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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Digital UNTAN</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Font Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="hero">
    <div class="container">
        <header>
            <div class="logo">INFORMATICS</div>
            <nav>
                <a href="index.php">Beranda</a>
                <a href="kontak.php">Kontak</a>
            </nav>
        </header>
        <main>
            <div class="text-section">
                <h1>Help Desk</h1>
                <h2>Apa yang kami bisa bantu?</h2>

                <form class="form-section">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" readonly>

                    <label for="email">E-Mail</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        readonly>
                    <textarea placeholder="Sampaikan pertanyaan atau kendala yang anda alami" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>

            <div class="image-section">
                <img src="assets/img/icon/chat.png" alt="Chat Icon">
            </div>
        </main>

        <footer>
            <a href="home.php" class="back-btn">← BACK</a>
        </footer>
    </div>
</body>

</html>