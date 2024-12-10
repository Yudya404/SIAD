<?php
include '../koneksi.php'; // Menggunakan koneksi ke basis data Anda
session_start();
date_default_timezone_set('Asia/Jakarta');

$arsip_waktu_upload = date('Y-m-d H:i:s');
$waktu_input = date('j F Y H:i:s');
$arsip_petugas = $_SESSION['id'];
$nama_pemohon = $_POST['nama']; // Ganti nama variabel agar tidak konflik
$pemohon_nomor = $_POST['nomor']; // Ganti nama variabel agar tidak konflik

// Fungsi untuk membaca kode arsip terakhir dari tabel
function getLastKodeArsip1($koneksi) {
    // Mendapatkan kode arsip terakhir dari tabel
    $query_last_kode_arsip = "SELECT arsip_kode FROM arsip ORDER BY arsip_id DESC LIMIT 1";
    $result_last_kode_arsip = mysqli_query($koneksi, $query_last_kode_arsip);

    if ($result_last_kode_arsip && mysqli_num_rows($result_last_kode_arsip) > 0) {
        $row_last_kode_arsip = mysqli_fetch_assoc($result_last_kode_arsip);
        return $row_last_kode_arsip['arsip_kode'];
    } else {
        return null; // Kembalikan null jika tidak ada kode arsip dalam tabel
    }
}

// Fungsi untuk memisahkan kode arsip dan membaca nomor lemari
function getNomorLemariFromKodeArsip($arsip_kode) {
    // Memisahkan kode arsip menjadi bagian-bagian
    $bagian_kode = explode('-', $arsip_kode);

    // Mengambil nomor lemari dari bagian yang sesuai (di sini kita asumsikan nomor lemari berada di posisi pertama)
    $nomor_lemari = $bagian_kode[0];

    return $nomor_lemari;
}

// Fungsi untuk membaca nomor lemari terakhir dari tabel
function getLastNomorLemari($koneksi) {
    // Mendapatkan nomor lemari terakhir dari tabel
    $query_last_nomor_lemari = "SELECT arsip_kode FROM arsip ORDER BY arsip_id DESC LIMIT 1";
    $result_last_nomor_lemari = mysqli_query($koneksi, $query_last_nomor_lemari);

    if ($result_last_nomor_lemari && mysqli_num_rows($result_last_nomor_lemari) > 0) {
        $row_last_nomor_lemari = mysqli_fetch_assoc($result_last_nomor_lemari);
        $arsip_kode_terakhir = $row_last_nomor_lemari['arsip_kode'];
        return getNomorLemariFromKodeArsip($arsip_kode_terakhir);
    } else {
        return null; // Kembalikan null jika tidak ada nomor lemari dalam tabel
    }
}

// Fungsi untuk menentukan nomor lemari selanjutnya
function getNextLemariNumber($koneksi) {
    // Mendapatkan jumlah data pada tabel arsip
    $query_total_arsip = "SELECT COUNT(*) AS total_arsip FROM arsip";
    $result_total_arsip = mysqli_query($koneksi, $query_total_arsip);
    $row_total_arsip = mysqli_fetch_assoc($result_total_arsip);
    $total_arsip = $row_total_arsip['total_arsip'];

    // Jika jumlah data belum mencapai atau melebihi 10500, ambil nomor lemari terakhir dan tambahkan 1
    if ($total_arsip < 10500) {
        $kode_arsip_terakhir = getLastKodeArsip1($koneksi);
        if ($kode_arsip_terakhir !== null) {
            $nomor_lemari_terakhir = getNomorLemariFromKodeArsip($kode_arsip_terakhir);
            $nomor_lemari_selanjutnya = $nomor_lemari_terakhir;
        } else {
            $nomor_lemari_selanjutnya = 1;
        }
    } else {
        // Jika jumlah data sudah mencapai atau melebihi 10500, tambahkan 1 ke nomor lemari terakhir
        $nomor_lemari_terakhir = getLastNomorLemari($koneksi);
        $nomor_lemari_selanjutnya = $nomor_lemari_terakhir + 1;
    }

    // Format nomor lemari dengan lebar 2 digit
    $nomor_lemari_formatted = str_pad($nomor_lemari_selanjutnya, 2, '0', STR_PAD_LEFT);

    return $nomor_lemari_formatted;
}

// Contoh penggunaan
$nomor_lemari_selanjutnya = getNextLemariNumber($koneksi);

// Fungsi untuk menghasilkan kode loker secara otomatis
function generateLokerNumber($koneksi) {
    // Mendapatkan total jumlah berkas
    $query_total_berkas = "SELECT COUNT(*) AS total_berkas FROM arsip";
    $result_total_berkas = mysqli_query($koneksi, $query_total_berkas);
    $row_total_berkas = mysqli_fetch_assoc($result_total_berkas);
    $total_berkas = $row_total_berkas['total_berkas'];

    // Tentukan batas untuk reset ke A.01 (misalnya, 10500 untuk A)
    $batas_reset_A = 10500;

    if ($total_berkas >= $batas_reset_A) {
        // Buat nama tabel baru
        $nama_tabel_baru = 'lemari_' . ceil($total_berkas / $batas_reset_A);

        // Cek apakah tabel baru sudah ada
        $query_check_table = "SHOW TABLES LIKE '$nama_tabel_baru'";
        $result_check_table = mysqli_query($koneksi, $query_check_table);

        if (mysqli_num_rows($result_check_table) == 0) {
            // Jika tabel baru belum ada, buat tabel baru
            $query_create_table = "CREATE TABLE $nama_tabel_baru LIKE arsip";
            mysqli_query($koneksi, $query_create_table);
        }

        // Transfer data dari tabel lama ke tabel baru
        $query_transfer_data = "INSERT INTO $nama_tabel_baru SELECT * FROM arsip LIMIT 10500";
        mysqli_query($koneksi, $query_transfer_data);

        // Hapus data dari tabel lama
        $query_delete_data = "DELETE FROM arsip LIMIT 10500";
        mysqli_query($koneksi, $query_delete_data);

        // Hitung nomor loker setelah reset A
        $nomor_loker_setelah_reset_A = floor(($total_berkas - $batas_reset_A) / 350) % 10 + 1;
        $kode_loker_setelah_reset_A = 'A.' . str_pad($nomor_loker_setelah_reset_A, 2, '0', STR_PAD_LEFT);
        return $kode_loker_setelah_reset_A;
    } else {
        // Lanjutkan dengan menghitung kode loker berdasarkan jumlah berkas sebelum reset
        $kode_huruf = chr(65 + floor(($total_berkas) / 3500));
        $nomor_loker = str_pad((floor(($total_berkas) / 350) % 10) + 1, 2, '0', STR_PAD_LEFT);
        $kode_loker = $kode_huruf . '.' . $nomor_loker;

        return $kode_loker;
    }
}

// Penggunaan:
$kode_loker = generateLokerNumber($koneksi);

// Fungsi untuk membaca kode arsip terakhir dari tabel
function getLastKodeArsip($koneksi) {
    // Mendapatkan kode arsip terakhir dari tabel
    $query_last_kode_arsip = "SELECT arsip_kode FROM arsip ORDER BY arsip_id DESC LIMIT 1";
    $result_last_kode_arsip = mysqli_query($koneksi, $query_last_kode_arsip);

    if ($result_last_kode_arsip && mysqli_num_rows($result_last_kode_arsip) > 0) {
        $row_last_kode_arsip = mysqli_fetch_assoc($result_last_kode_arsip);
        return $row_last_kode_arsip['arsip_kode'];
    } else {
        return null; // Kembalikan null jika tidak ada kode arsip dalam tabel
    }
}

// Fungsi untuk memisahkan kode arsip dan membaca nomor berkas
function getNomorBerkasFromKodeArsip($arsip_kode) {
    // Memisahkan kode arsip menjadi bagian-bagian
    $bagian_kode = explode('-', $arsip_kode);

    // Mengambil nomor berkas dari bagian yang sesuai (di sini kita asumsikan nomor berkas berada di posisi ketiga)
    $nomor_berkas = $bagian_kode[2];

    return $nomor_berkas;
}

// Fungsi untuk menentukan nomor berkas selanjutnya
function getNextBerkasNumber($koneksi) {
    // Mendapatkan kode arsip terakhir dari tabel
    $kode_arsip_terakhir = getLastKodeArsip($koneksi);

    if ($kode_arsip_terakhir !== null) {
        // Memisahkan kode arsip dan membaca nomor berkas terakhir dari kode arsip dalam tabel
        $nomor_berkas_terakhir = getNomorBerkasFromKodeArsip($kode_arsip_terakhir);

        // Menaikkan nomor berkas terakhir untuk mendapatkan nomor berkas selanjutnya
        $nomor_berkas_selanjutnya = $nomor_berkas_terakhir + 1;
    } else {
        // Jika tidak ada kode arsip sebelumnya, mulai dari 1
        $nomor_berkas_selanjutnya = 1;
    }

    // Format nomor berkas dengan lebar 5 digit
    $nomor_berkas_formatted = str_pad($nomor_berkas_selanjutnya, 5, '0', STR_PAD_LEFT);

    return $nomor_berkas_formatted;
}

// Contoh penggunaan
$nomor_berkas_selanjutnya = getNextBerkasNumber($koneksi);

$arsip_kode = $nomor_lemari_selanjutnya . '-' . $kode_loker . '-' . $nomor_berkas_selanjutnya . '-' . $pemohon_nomor;

// Cek apakah kode_arsip sudah ada dalam database
$cek_kode_query = "SELECT * FROM arsip WHERE arsip_kode = '$arsip_kode'";
$cek_kode_result = mysqli_query($koneksi, $cek_kode_query);

// Cek apakah pemohon_nomor sudah ada dalam database
$cek_pemohon_query = "SELECT * FROM arsip WHERE pemohon_nomor = '$pemohon_nomor'";
$cek_pemohon_result = mysqli_query($koneksi, $cek_pemohon_query);

if (mysqli_num_rows($cek_kode_result) > 0) {
    echo "
        <script>
            console.log('Data Arsip dengan Kode Arsip $arsip_kode sudah ada dalam database. Mohon gunakan data yang berbeda.');
            setTimeout(function() {
                window.location = 'arsip_upload.php';
            }, 500); // 100ms delay before redirect
        </script>
    ";
} elseif (mysqli_num_rows($cek_pemohon_result) > 0) {
    echo "
        <script>
            console.log('Data Arsip dengan Nomor Pemohon $pemohon_nomor sudah ada dalam database. Mohon gunakan Nomor Pemohon yang berbeda.');
            setTimeout(function() {
                window.location = 'arsip_upload.php';
            }, 500); // 100ms delay before redirect
        </script>
    ";
} else {
    // Tidak ada kesamaan pada arsip_kode atau pemohon_nomor, masukkan data baru ke dalam database
    $insert_query = "INSERT INTO arsip (arsip_waktu_upload, arsip_petugas, arsip_kode, nama_pemohon, pemohon_nomor) VALUES ('$arsip_waktu_upload', '$arsip_petugas', '$arsip_kode', '$nama_pemohon', '$pemohon_nomor')";

    // Jalankan query untuk memasukkan data ke tabel 'arsip'
    if (mysqli_query($koneksi, $insert_query)) {
        echo "
            <script>
                console.log('Data Arsip dengan Kode Lokasi $arsip_kode berhasil disimpan pada tanggal $waktu_input');
                setTimeout(function() {
                    window.location = 'arsip_upload.php';
                }, 500); // 100ms delay before redirect
            </script>
        ";
    } else {
        // Data gagal disimpan di tabel 'arsip', tampilkan pesan kesalahan
        echo "
            <script>
                console.error('Gagal menyimpan data di tabel arsip: " . mysqli_error($koneksi) . "');
                setTimeout(function() {
                    window.location = 'arsip_upload.php';
                }, 500); // 100ms delay before redirect
            </script>
        ";
    }
}

// Jangan lupa tutup koneksi ke database jika tidak digunakan lagi
mysqli_close($koneksi);
?>
