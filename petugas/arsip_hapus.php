<?php 
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $arsipId = mysqli_real_escape_string($koneksi, $_POST['id']);
    
    // Lakukan operasi penghapusan data dari database
    $query = "DELETE FROM arsip WHERE arsip_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $arsipId); // Menggunakan "i" untuk integer
    
    if (mysqli_stmt_execute($stmt)) {
        // Redirect atau respons langsung dapat digunakan, gunakan salah satu
        // header('Location: arsip.php');
        echo json_encode(array("message" => "Data Arsip berhasil dihapus."));
    } else {
        // Tambahkan penanganan kesalahan
        echo json_encode(array("message" => "Gagal menghapus data Arsip: " . mysqli_error($koneksi)));
    }
    
    mysqli_stmt_close($stmt);
    $koneksi->close();
}
?>