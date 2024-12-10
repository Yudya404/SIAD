<?php
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $arsip_kode = $_POST['arsip_kode'];
    $nama = $_POST['nama_pemohon'];
    $nomor = $_POST['pemohon_nomor'];
    $kategori = $_POST['arsip_kategori'];

    if (empty($id) || empty($arsip_kode) || empty($nama) || empty($nomor) || empty($kategori)) {
        echo "
            <script>
                alert('Harap lengkapi semua baris kolom isian.');
                window.location = 'arsip.php';
            </script>";
        exit();
    }

    // Mengambil kode_arsip yang lama
    $query_arsip = "SELECT arsip_kode FROM arsip WHERE arsip_id='$id'";
    $result = mysqli_query($koneksi, $query_arsip);
    $row = mysqli_fetch_assoc($result);
    $kode_arsip_lama = $row['arsip_kode'];

    // Mendapatkan bagian nomor_pemohon yang baru
    $nomor_pemohon_baru = substr($nomor, -2); // Mengambil 2 digit terakhir nomor

    // Menggabungkan kode_arsip dengan nomor_pemohon baru
    $kode_arsip_baru = preg_replace('/\d{2}$/', $nomor_pemohon_baru, $kode_arsip_lama);

    $query = "UPDATE arsip SET nama_pemohon='$nama', pemohon_nomor='$nomor', arsip_kategori='$kategori', arsip_kode='$kode_arsip_baru' WHERE arsip_id='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "
            <script>
                alert('Data Arsip dengan Kode $arsip_kode berhasil diubah');
                window.location = 'arsip.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Data Arsip dengan Kode $arsip_kode gagal diubah');
                window.location = 'arsip.php';
            </script>";
    }
} else {
    header("location:arsip.php");
}
?>
