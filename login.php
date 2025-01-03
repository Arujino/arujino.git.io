<?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Debug untuk melihat query
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $user['nama']; // mengambil nama dari database
        $_SESSION['logged_in'] = true;
        
        header("Location: home.php");
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Digital UNTAN</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
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
            <div class="form-section">
                <h1>Login</h1>
                <p>Gunakan akun SIAKAD untuk mengisi data di bawah ini</p>
                <?php if(isset($error)) { ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
            <div class="image-section">
                <img src="assets/img/icon/maps.png" alt="Map Icon">
            </div>
        </main>
        <footer>
            <a href="index.php" class="back-btn">← BACK</a>
        </footer>
    </div>
</body>
</html>
