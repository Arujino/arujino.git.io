<?php
require_once 'config/koneksi.php';

function getLaporanByRuangan($ruangan) {
    global $koneksi;
    
    // Ambil fasilitas_id berdasarkan ruangan
    $query_fasilitas = "SELECT id FROM fasilitas WHERE ruangan = '$ruangan'";
    $result_fasilitas = mysqli_query($koneksi, $query_fasilitas);
    $row_fasilitas = mysqli_fetch_assoc($result_fasilitas);
    $fasilitas_id = $row_fasilitas['id'];
    
    // Array untuk menyimpan hasil perhitungan
    $laporan = [
        'Kursi dan Meja' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'Papan Tulis' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'Spidol' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'Penghapus' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'LCD' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'Kipas' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'AC' => ['masuk' => 0, 'proses' => 0, 'updated' => '-'],
        'Lainnya' => ['masuk' => 0, 'proses' => 0, 'updated' => '-']
    ];
    
    // Query untuk mengambil semua laporan untuk ruangan tersebut
    $query = "SELECT deskripsi_masalah, proses, created_at 
             FROM pelaporan 
             WHERE fasilitas_id = $fasilitas_id 
             ORDER BY created_at DESC";
             
    $result = mysqli_query($koneksi, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Tentukan jenis perlengkapan berdasarkan deskripsi
        $deskripsi = strtolower($row['deskripsi_masalah']);
        $perlengkapan = 'Lainnya';
        
        // Cek kata kunci dalam deskripsi untuk menentukan jenis perlengkapan
        if (strpos($deskripsi, 'kursi') !== false || strpos($deskripsi, 'meja') !== false) {
            $perlengkapan = 'Kursi dan Meja';
        } elseif (strpos($deskripsi, 'papan') !== false) {
            $perlengkapan = 'Papan Tulis';
        } elseif (strpos($deskripsi, 'spidol') !== false) {
            $perlengkapan = 'Spidol';
        } elseif (strpos($deskripsi, 'penghapus') !== false) {
            $perlengkapan = 'Penghapus';
        } elseif (strpos($deskripsi, 'lcd') !== false) {
            $perlengkapan = 'LCD';
        } elseif (strpos($deskripsi, 'kipas') !== false) {
            $perlengkapan = 'Kipas';
        } elseif (strpos($deskripsi, 'ac') !== false) {
            $perlengkapan = 'AC';
        }
        
        $proses = $row['proses'];
        $created_at = date('d/m/Y', strtotime($row['created_at']));
        
        if ($proses == 'diproses') {
            $laporan[$perlengkapan]['proses']++;
        } else {
            $laporan[$perlengkapan]['masuk']++;
        }
        
        // Update tanggal terakhir jika belum diset
        if ($laporan[$perlengkapan]['updated'] == '-') {
            $laporan[$perlengkapan]['updated'] = $created_at;
        }
    }
    
    return $laporan;
}

if (isset($_GET['ruangan'])) {
    $ruangan = $_GET['ruangan'];
    $data = getLaporanByRuangan($ruangan);
    echo json_encode($data);
}
?> 