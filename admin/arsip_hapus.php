<?php 
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $arsipId = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Lakukan operasi penghapusan data dari database
    $query = "DELETE FROM arsip WHERE arsip_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $arsipId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
            alert('Data Arsip berhasil dihapus.');
            window.location = 'arsip.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal menghapus data Arsip.');
            window.location = 'arsip.php';
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    $koneksi->close();
}
