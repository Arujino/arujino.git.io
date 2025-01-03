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
            <a href="fasilitas.php"
                class="<?php echo ($current_page == 'fasilitas.php') ? 'active' : ''; ?>">Fasilitas</a>
            <a href="pelaporan.php"
                class="<?php echo ($current_page == 'pelaporan.php') ? 'active' : ''; ?>">Pelaporan</a>
            <a href="tentang.php" class="<?php echo ($current_page == 'tentang.php') ? 'active' : ''; ?>">Tentang</a>
            <a href="helpdesk.php" class="<?php echo ($current_page == 'helpdesk.php') ? 'active' : ''; ?>">Help
                Desk</a>
        </div>
    </nav>

    <div class="fasilitas-container">
        <h1>FASILITAS FAKULTAS TEKNIK UNIVERSITAS TANJUNGPURA</h1>

        <div class="fasilitas-content">
            <div class="fasilitas-menu">
                <div class="accordion-container">
                    <button class="accordion">RUANG KELAS</button>
                    <div class="panel">
                        <?php
                        require_once 'config/koneksi.php';
                        $query = "SELECT ruangan FROM fasilitas ORDER BY ruangan ASC";
                        $result = mysqli_query($koneksi, $query);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="#" data-room-id="' . $row['ruangan'] . '" onclick="showFacilityDetail(\'' . $row['ruangan'] . '\', event)">' . $row['ruangan'] . '</a>';
                            }
                        } else {
                            echo "Error: " . mysqli_error($koneksi);
                        }
                        ?>
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">LABORATORIUM</button>
                    <div class="panel">
                        <!-- isi dengan daftar laboratorium -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">AKADEMIK</button>
                    <div class="panel">
                        <!-- isi dengan daftar ruang akademik -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">PERPUSTAKAAN</button>
                    <div class="panel">
                        <!-- isi dengan daftar ruang perpustakaan -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">PARKIR</button>
                    <div class="panel">
                        <!-- isi dengan daftar area parkir -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">TOILET</button>
                    <div class="panel">
                        <!-- isi dengan daftar toilet -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">MUSHOLA</button>
                    <div class="panel">
                        <!-- isi dengan daftar mushola -->
                    </div>
                </div>

                <div class="accordion-container">
                    <button class="accordion">KANTIN</button>
                    <div class="panel">
                        <!-- isi dengan daftar kantin -->
                    </div>
                </div>
            </div>

            <div class="fasilitas-detail">
                <div class="placeholder-text">
                    Pilih ruangan untuk mendapatkan informasi . . .
                </div>
                <div class="facility-info" style="display: none;">
                    <h2>Ruang Kelas <span id="roomNumber"></span></h2>
                    <div class="info-section">
                        <div class="equipment-list">
                            <div class="equipment-row">
                                <span class="equipment-name">Luas Ruangan</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="luas-ruangan">-</span>
                                <span class="unit">set</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Kursi dan Meja</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="kursi-meja">-</span>
                                <span class="unit">set</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Papan Tulis</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="papan-tulis">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Spidol</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="spidol">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Penghapus</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="penghapus">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">LCD</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="lcd">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Kipas</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="kipas">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">AC</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="ac">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Lokasi</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="lokasi">-</span>
                            </div>
                            <div class="equipment-row">
                                <span class="equipment-name">Virtual Tour</span>
                                <span class="separator">:</span>
                                <span class="equipment-value" id="virtual_tour">-</span>
                            </div>
                            <div class="info-row">
                                <span><a href="form_pelaporan.php" class="info-link">Buat Laporan</a></span>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="pelaporan-view" style="display: none;"></div>
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

    <script src="assets/js/fasilitas.js"></script>
</body>

</html>