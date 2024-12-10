<?php
session_start(); // Pastikan session sudah dimulai

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir dan bersihkan input
	$user_id			= mysqli_real_escape_string($koneksi, $_POST['id']); // Tidak perlu di-escape karena ini dari session
	$user_nip			= mysqli_real_escape_string($koneksi, $_POST['nip']);
    $user_nama			= mysqli_real_escape_string($koneksi, $_POST['nama']);
	$user_email			= mysqli_real_escape_string($koneksi, $_POST['email']);
    $user_notelp		= mysqli_real_escape_string($koneksi, $_POST['notelp']);
    $user_alamat		= mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Data upload gambar
    $targetDir = "../gambar/user/";
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
                  window.location = 'user.php?kode=" . $user_id . "';
                </script>
              ";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                // File berhasil diunggah, lakukan proses update data
                $sql = "UPDATE user SET user_nip=?, user_nama=?, user_email=?, user_notelp=?, user_alamat=?, user_foto=? WHERE user_id=?";
                $stmt = mysqli_prepare($koneksi, $sql);
                mysqli_stmt_bind_param($stmt, "sssssss", $user_nip, $user_nama, $user_email, $user_notelp, $user_alamat, $targetFile, $user_id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "
                        <script>
                        alert('Data Anda dengan NIP $user_nip berhasil diubah');
                        window.location = 'user.php';
                        </script>
                    ";
                } else {
                    $errorMessage = mysqli_error($koneksi);
                    echo "
                        <script>
                        alert('Mohon Cek Kembali Data Yang Anda Masukkan! Pesan Kesalahan: $errorMessage');
                        window.location = 'user.php';
                        </script>
                    ";
                }

                mysqli_stmt_close($stmt);
            } else {
                $errorMessage = mysqli_error($koneksi);
				echo "
                   <script>
                    alert('Maaf, terjadi kesalahan saat mengunggah file Pesan Kesalahan: $errorMessage');
                    window.location = 'user.php';
                   </script>
                  ";
            }
        }
    } else {
        // Jika gambar tidak diupload, lakukan proses update data tanpa mengubah foto
        $sql = "UPDATE user SET user_nip=?, user_nama=?, user_email=?, user_notelp=?, user_alamat=? WHERE user_id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $user_nip, $user_nama, $user_email, $user_notelp, $user_alamat, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                alert('Data Anda dengan NIP $user_nip berhasil diubah');
                window.location = 'user.php';
                </script>
            ";
        } else {
            $errorMessage = mysqli_error($koneksi);
            echo "
               <script>
                 alert('Mohon Cek Kembali Data Yang Anda Masukkan! Pesan Kesalahan: $errorMessage');
                 window.location = 'user.php';
               </script>
             ";
        }

        mysqli_stmt_close($stmt);
    }

    $koneksi->close();
}
?>

