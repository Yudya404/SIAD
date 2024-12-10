<?php
session_start(); // Pastikan session sudah dimulai

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir dan bersihkan input
	$admin_id			= $_SESSION['id']; // Tidak perlu di-escape karena ini dari session
	$admin_nip			= mysqli_real_escape_string($koneksi, $_POST['nip']);
    $admin_nama			= mysqli_real_escape_string($koneksi, $_POST['nama']);
	$admin_email		= mysqli_real_escape_string($koneksi, $_POST['email']);
    $admin_notelp		= mysqli_real_escape_string($koneksi, $_POST['notelp']);
    $admin_alamat		= mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Tentukan zona waktu Anda
    date_default_timezone_set("Asia/Jakarta"); // Ganti "Asia/Jakarta" sesuai dengan zona waktu Anda

    // Ambil tanggal sekarang dengan format yang diinginkan (misalnya, Y-m-d)
    $waktu_input = date('j F Y H:i:s');

    // Data upload gambar
    $targetDir = "../gambar/admin/";
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
                  window.location = 'profil.php?kode=" . $admin_id . "';
                </script>
              ";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                // File berhasil diunggah, lakukan proses update data
                $sql = "UPDATE admin SET admin_nip=?, admin_nama=?, admin_email=?, admin_notelp=?, admin_alamat=?, admin_foto=? WHERE admin_id=?";
                $stmt = mysqli_prepare($koneksi, $sql);
                mysqli_stmt_bind_param($stmt, "sssssss", $admin_nip, $admin_nama, $admin_email, $admin_notelp, $admin_alamat, $targetFile, $admin_id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "
                        <script>
                        alert('Data Anda dengan NIP $admin_nip berhasil diubah pada tanggal $waktu_input');
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
        $sql = "UPDATE admin SET admin_nip=?, admin_nama=?, admin_email=?, admin_notelp=?, admin_alamat=? WHERE admin_id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $admin_nip, $admin_nama, $admin_email, $admin_notelp, $admin_alamat, $admin_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                alert('Data Anda dengan NIP $admin_nip berhasil diubah pada tanggal $waktu_input');
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

