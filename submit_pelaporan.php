<?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil user_id dari session
    $user_id = $_SESSION['user_id'];
    
    // Ambil fasilitas_id berdasarkan ruangan yang dipilih
    $ruangan = mysqli_real_escape_string($koneksi, $_POST['fasilitas']);
    $query_fasilitas = "SELECT id FROM fasilitas WHERE ruangan = '$ruangan'";
    $result_fasilitas = mysqli_query($koneksi, $query_fasilitas);
    
    if ($row_fasilitas = mysqli_fetch_assoc($result_fasilitas)) {
        $fasilitas_id = $row_fasilitas['id'];
        
        // Ambil data dari form
        $deskripsi_masalah = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
        
        // Handle upload file bukti
        $bukti = "";
        if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
            $bukti = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $bukti;
            
            if (!move_uploaded_file($_FILES['bukti']['tmp_name'], $target_file)) {
                die("Gagal mengupload file bukti.");
            }
        }
        
        // Insert data ke tabel pelaporan
        $query = "INSERT INTO pelaporan (user_id, fasilitas_id, deskripsi_masalah, bukti, created_at) 
                 VALUES (?, ?, ?, ?, NOW())";
                 
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "iiss", $user_id, $fasilitas_id, $deskripsi_masalah, $bukti);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            $_SESSION['pesan'] = "Pelaporan berhasil dikirim!";
            header("Location: pelaporan.php");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            die("Error: " . mysqli_error($koneksi));
        }
    } else {
        die("Error: Fasilitas tidak ditemukan");
    }
}
?> 