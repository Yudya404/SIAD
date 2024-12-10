<?php
session_start();

include '../koneksi/koneksi.php'; // Pastikan Anda telah memasukkan koneksi ke database

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Membaca isi file SQL
$query = file_get_contents("ecommerce.sql");

// Mengeksekusi perintah SQL
if ($conn->multi_query($query)) {
    echo "
    <script>
    alert('RETRIEVE DATABASE BERHASIL');
    window.location = '../index.php';
    </script>
    ";
} else {
    echo "Gagal: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
