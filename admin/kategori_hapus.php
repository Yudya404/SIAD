<?php 
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $kategoriId = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Lakukan operasi penghapusan data dari database
    $query = "DELETE FROM kategori WHERE kategori_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $kategoriId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
            alert('Data Kategori berhasil dihapus.');
            window.location = 'kategori.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal menghapus data Kategori.');
            window.location = 'kategori.php';
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    $koneksi->close();
}
