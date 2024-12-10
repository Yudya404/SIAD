<?php
session_start(); // Pastikan session sudah dimulai

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir dan bersihkan input
	$petugas_id			= $_SESSION['id']; // Tidak perlu di-escape karena ini dari session
    $petugas_nama		= mysqli_real_escape_string($koneksi, $_POST['petugas_nama']);
	$petugas_email		= mysqli_real_escape_string($koneksi, $_POST['petugas_email']);
    $petugas_notelp		= mysqli_real_escape_string($koneksi, $_POST['petugas_notelp']);
    $petugas_alamat		= mysqli_real_escape_string($koneksi, $_POST['petugas_alamat']);

    // Tentukan zona waktu Anda
    date_default_timezone_set("Asia/Jakarta"); // Ganti "Asia/Jakarta" sesuai dengan zona waktu Anda

    // Ambil tanggal sekarang dengan format yang diinginkan (misalnya, Y-m-d)
    $tgl_input = date("Y-m-d");

    // Data upload gambar
    $targetDir = "../gambar/petugas/";
    $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // ... (validasi gambar seperti yang sudah Anda berikan)

    // Jika gambar diupload, lakukan proses upload dan update data
    if (!empty($_FILES["foto"]["name"])) {
        if ($uploadOk == 0) {
			$errorMessage = mysqli_error($koneksi);
			echo "
                <script>
                  alert('Maaf, file tidak berhasil diunggah.! Pesan Kesalahan: $errorMessage');
                  window.location = 'profil.php?kode=" . $petugas_id . "';
                </script>
              ";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                // File berhasil diunggah, lakukan proses update data
                $sql = "UPDATE petugas SET petugas_nama=?, petugas_email=?, petugas_notelp=?, petugas_alamat=?, petugas_foto=? WHERE petugas_id=?";
                $stmt = mysqli_prepare($koneksi, $sql);
                mysqli_stmt_bind_param($stmt, "ssssss", $petugas_nama, $petugas_email, $petugas_notelp, $petugas_alamat, $targetFile, $petugas_id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "
                        <script>
                        alert('Data Anda berhasil diubah pada tanggal $tgl_input');
                        window.location = 'profil.php';
                        </script>
                    ";
                } else {
                    $errorMessage = mysqli_error($koneksi);
                    echo "
                        <script>
                        alert('Mohon Cek Kembali Data Yang Anda Masukkan! Pesan Kesalahan: $errorMessage');
                        window.location = 'profil.php';
                        </script>
                    ";
                }

                mysqli_stmt_close($stmt);
            } else {
                $errorMessage = mysqli_error($koneksi);
				echo "
                   <script>
                    alert('Maaf, terjadi kesalahan saat mengunggah file Pesan Kesalahan: $errorMessage');
                    window.location = 'profil.php';
                   </script>
                  ";
            }
        }
    } else {
        // Jika gambar tidak diupload, lakukan proses update data tanpa mengubah foto
        $sql = "UPDATE petugas SET petugas_nama=?, petugas_email=?, petugas_notelp=?, petugas_alamat=? WHERE petugas_id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $petugas_nama, $petugas_email, $petugas_notelp, $petugas_alamat, $petugas_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                alert('Data Anda berhasil diubah pada tanggal $tgl_input');
                window.location = 'profil.php';
                </script>
            ";
        } else {
            $errorMessage = mysqli_error($koneksi);
            echo "
               <script>
                 alert('Mohon Cek Kembali Data Yang Anda Masukkan! Pesan Kesalahan: $errorMessage');
                 window.location = 'profil.php';
               </script>
             ";
        }

        mysqli_stmt_close($stmt);
    }

    $koneksi->close();
}
?>

