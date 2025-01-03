<?php
require_once 'config/koneksi.php';

if (isset($_GET['ruangan'])) {
    $ruangan = mysqli_real_escape_string($koneksi, $_GET['ruangan']);
    
    $query = "SELECT * FROM fasilitas WHERE ruangan = '$ruangan'";
    $result = mysqli_query($koneksi, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Menyiapkan data response
        $response = array(
            'ruangan' => $data['ruangan'],
            'luas_ruangan' => $data['luas_ruangan'],
            'kursi_dan_meja' => $data['kursi_dan_meja'],
            'papan_tulis' => $data['papan_tulis'],
            'spidol' => $data['spidol'],
            'penghapus' => $data['penghapus'],
            'lcd' => $data['lcd'],
            'kipas' => $data['kipas'],
            'ac' => $data['ac'],
            'lokasi' => $data['lokasi'],
            'virtual_tour' => $data['virtual_tour']
        );
        
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
}
?>