<?php 
include '../koneksi.php';
$id = $_GET['id'];

if (mysqli_query($koneksi, "delete from kategori where kategori_id='$id'")) {
    echo "
    <script>
        alert('Data Kategori dengan kode $kategori_id berhasil dihapus');
        window.location = 'kategori.php';
    </script>";
} else {
    echo "
    <script>
        alert('Data Kategori dengan kode $kategori_id Gagal dihapus');
        window.location = 'kategori.php';
    </script>";
}
