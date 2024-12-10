<?php
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['kategori_nama'];
    $ket = $_POST['kategori_keterangan'];

    if (empty($id) || empty($nama) || empty($ket)) {
        echo "
            <script>
                alert('Harap mengisi semua baris form yang tersedia.');
                window.location = 'kategori.php';
            </script>";
        exit();
    }

    $query = "UPDATE kategori SET kategori_nama='$nama', kategori_keterangan='$ket' WHERE kategori_id='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "
            <script>
                alert('Data Kategori berhasil diupdate');
                window.location = 'kategori.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Data Kategori Gagal diupdate. Silakan coba lagi.');
                window.location = 'kategori.php';
            </script>";
    }
} else {
    header("location:kategori.php");
}
?>
