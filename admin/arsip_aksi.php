<?php
include '../koneksi.php'; // Menggunakan koneksi ke basis data Anda
session_start();
date_default_timezone_set('Asia/Jakarta');

$arsip_waktu_upload = date('Y-m-d H:i:s');
$waktu_upload = date('j F Y H:i:s');
$arsip_petugas = $_SESSION['id'];
$nama_pemohon = $_POST['nama']; // Ganti nama variabel agar tidak konflik
$pemohon_nomor = $_POST['nomor']; // Ganti nama variabel agar tidak konflik
$arsip_kategori = $_POST['kategori'];

// Fungsi untuk menghasilkan kode user yang unik
function generateArsipId($koneksi) {
    $query = mysqli_query($koneksi, "SELECT arsip_id FROM arsip ORDER BY arsip_id DESC LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $num = (int) substr($data['arsip_id'], 1) + 1;
    } else {
        $num = 1;
    }

    str_pad($num, 3, '0', STR_PAD_LEFT);
}

$arsip_id = generateArsipId($koneksi);

// Fungsi untuk menghasilkan kode user yang unik
function generateLemariId($koneksi) {
    $query = mysqli_query($koneksi, "SELECT id_lemari FROM lemari ORDER BY id_lemari DESC LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $num = (int) substr($data['id_lemari'], 1) + 1;
    } else {
        $num = 1;
    }

    str_pad($num, 3, '0', STR_PAD_LEFT);
}

$id_lemari = generateLemariId($koneksi);

// Fungsi untuk menghasilkan kode user yang unik
function generateLokerId($koneksi) {
    $query = mysqli_query($koneksi, "SELECT id_lokasi FROM lokasi ORDER BY id_lokasi DESC LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $num = (int) substr($data['id_lokasi'], 1) + 1;
    } else {
        $num = 1;
    }

    str_pad($num, 3, '0', STR_PAD_LEFT);
}

$id_lokasi = generateLokerId($koneksi);

// Fungsi untuk menghasilkan nomor lemari secara otomatis
function generateLemariNumber($koneksi) {
    // Mendapatkan total jumlah lemari yang ada
    $query_total_lemari = "SELECT COUNT(*) AS total_lemari FROM lemari";
    $result_total_lemari = mysqli_query($koneksi, $query_total_lemari);
    $row_total_lemari = mysqli_fetch_assoc($result_total_lemari);
    $total_lemari = $row_total_lemari['total_lemari'];

    // Jika belum mencapai 18.000, maka tetapkan nomor lemari "01"
    if ($total_lemari < 300) {
        $nomor_lemari = '01';
    } else {
        // Jika sudah mencapai 18.000, maka tingkatkan nomor lemari
        $query_last_lemari = "SELECT MAX(nomor_lemari) AS max_nomor FROM lemari";
        $result_last_lemari = mysqli_query($koneksi, $query_last_lemari);
        $row_last_lemari = mysqli_fetch_assoc($result_last_lemari);
        $nomor_lemari_terakhir = $row_last_lemari['max_nomor'];

        // Pemisahan awalan dan nomor
        list($awalan, $nomor) = explode('.', $nomor_lemari_terakhir);

        // Menentukan nomor lemari berikutnya
        $nomor_lemari = $awalan . '.' . str_pad((int)$nomor, 2, '0', STR_PAD_LEFT);
    }

    return $nomor_lemari;
}

$nomor_lemari = generateLemariNumber($koneksi);

// Fungsi untuk menghasilkan nomor loker secara otomatis
function generateLokerNumber($koneksi) {
    // Mendapatkan total jumlah loker yang ada
    $query_total_loker = "SELECT COUNT(*) AS total_loker FROM lokasi";
    $result_total_loker = mysqli_query($koneksi, $query_total_loker);
    $row_total_loker = mysqli_fetch_assoc($result_total_loker);
    $total_loker = $row_total_loker['total_loker'];

    // Menghitung huruf awalan
    $awalan_huruf = chr(65 + floor($total_loker / 10));

    // Pengecekan apakah nomor loker mencapai 0-9 atau 0-10
    if ($total_loker % 10 === 9) {
        // Jika nomor loker mencapai 0-9, tampilkan pesan loker baru
        $nomor_loker = $awalan_huruf . '.' . str_pad(($total_loker % 10 + 1), 2, '0', STR_PAD_LEFT);
        echo "
			<script>
				alert('Jumlah berkas dalam loker dengan Kode $awalan_huruf ini telah mencapai batas maksimal penyimpanan, Anda akan diarahkan ke loker berikutnya.');
				window.location = 'arsip.php';
			</script>";
    } else if ($total_loker % 10 === 0) {
        // Jika nomor loker mencapai 0-9, tampilkan pesan loker berikutnya
        $awalan_huruf = chr(65 + floor(($total_loker + 1) / 10));
        $nomor_loker = $awalan_huruf . '.' . str_pad(($total_loker % 10 + 1), 2, '0', STR_PAD_LEFT);
        echo "
			<script>
				alert('Membuat kode loker baru dengan Kode $nomor_loker');
				window.location = 'arsip.php';
			</script>";
    } else {
        // Jika tidak mencapai batas, tetapkan nomor loker biasa
        $nomor_loker = $awalan_huruf . '.' . str_pad(($total_loker % 10 + 1), 2, '0', STR_PAD_LEFT);
    }
    
    return $nomor_loker;
}

$nomor_loker = generateLokerNumber($koneksi);

// Fungsi untuk menghasilkan nomor lemari secara otomatis
function generateBerkasNumber($koneksi) {
    // Mendapatkan total jumlah berkas yang ada
    $query_total_berkas = "SELECT COUNT(*) AS total_berkas FROM arsip";
    $result_total_berkas = mysqli_query($koneksi, $query_total_berkas);
    $row_total_berkas = mysqli_fetch_assoc($result_total_berkas);
    $total_berkas = $row_total_berkas['total_berkas'];

    // Menentukan awalan nomor berkas (00001, 00002, 00003, dst.) dengan lebar 5 digit
    $nomor_berkas = str_pad($total_berkas + 1, 5, '0', STR_PAD_LEFT);

    return $nomor_berkas;
}

$nomor_berkas = generateBerkasNumber($koneksi);

// Membuat kode_arsip dengan format yang sesuai
$arsip_kode = $nomor_lemari . '-' . $nomor_loker . '-' . $nomor_berkas . '-' . $pemohon_nomor;

// Cek apakah kode_arsip sudah ada dalam database
$cek_kode_query = "SELECT * FROM arsip WHERE arsip_kode = '$arsip_kode'";
$cek_kode_result = mysqli_query($koneksi, $cek_kode_query);

if (mysqli_num_rows($cek_kode_result) > 0) {
    echo "
		<script>
			alert('Data Anda dengan Nomor Pemohon berikut $pemohon_nomor sudah ada didalam database. Mohon gunakan Nomor Pemohon yang berbeda.');
			window.location = 'arsip.php';
		</script>
		";
}

// Query untuk memasukkan data ke tabel 'arsip'
$insert_query = "INSERT INTO arsip (arsip_id, arsip_waktu_upload, arsip_petugas, arsip_kode, nama_pemohon, pemohon_nomor, arsip_kategori) VALUES ('$arsip_id','$arsip_waktu_upload','$arsip_petugas','$arsip_kode','$nama_pemohon','$pemohon_nomor','$arsip_kategori')";

// Jalankan query untuk memasukkan data ke tabel 'arsip'
if (mysqli_query($koneksi, $insert_query)) {
    // Data berhasil disimpan di tabel 'arsip'
    
    // Lakukan tindakan sesuai dengan kode arsip yang telah dihasilkan
    // Misalnya, Anda ingin memasukkan data ke dalam tabel 'lemari' dan 'lokasi'
    $insert_lemari = "INSERT INTO lemari (id_lemari, nomor_lemari) VALUES ('$id_lemari', '$nomor_lemari')";
    $insert_loker = "INSERT INTO lokasi (id_lokasi, nomor_loker) VALUES ('$id_lokasi', '$nomor_loker')";

    // Jalankan query untuk memasukkan data ke tabel 'lemari' dan 'lokasi'
    if (mysqli_query($koneksi, $insert_lemari) && mysqli_query($koneksi, $insert_loker)) {
        // Data berhasil disimpan di tabel 'lemari' dan 'lokasi'
       echo "
			<script>
				alert('Data Anda dengan Kode Lokasi $arsip_kode berhasil disimpan pada tanggal $waktu_upload');
                window.location = 'arsip.php';
            </script>
            ";
    } else {
        // Data gagal disimpan di tabel 'lemari' dan 'lokasi'
        echo "Gagal menyimpan data di tabel lemari atau lokasi: " . mysqli_error($koneksi);
    }
} else {
    // Data gagal disimpan di tabel 'arsip', tampilkan pesan kesalahan
    echo "Gagal menyimpan data di tabel arsip: " . mysqli_error($koneksi);
}

// Jangan lupa tutup koneksi ke database jika tidak digunakan lagi
mysqli_close($koneksi);
?>
