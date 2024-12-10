<?php
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_nama = $_POST['kategori_nama'];
    $kategori_keterangan = $_POST['kategori_keterangan'];

    // Validasi data
    if (empty($kategori_nama) || empty($kategori_keterangan)) {
        echo "
        <script>
            alert('Semua form harus diisi');
            window.location = 'kategori.php';
        </script>";
    } else {
        // Lakukan penyisipan data ke database
        $query = "INSERT INTO kategori (kategori_nama, kategori_keterangan) VALUES ('$kategori_nama', '$kategori_keterangan')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "
            <script>
                alert('Kategori berhasil ditambahkan');
                window.location = 'kategori.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal menambahkan kategori');
                window.location = 'kategori.php';
            </script>";
        }
    }
} else {
    echo "Akses tidak valid";
}
?>
