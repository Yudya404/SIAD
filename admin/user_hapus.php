<?php 
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $petugasId = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Lakukan operasi penghapusan data dari database
    $query = "DELETE FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $petugasId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
            alert('Data Petugas berhasil dihapus.');
            window.location = 'user.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal menghapus data Petugas.');
            window.location = 'user.php';
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    $koneksi->close();
}
