<?php
session_start();

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
    $user_nip 			= mysqli_real_escape_string($koneksi, $_POST['nip']);
	$user_nama 			= mysqli_real_escape_string($koneksi, $_POST['nama']);
    $user_notelp 		= mysqli_real_escape_string($koneksi, $_POST['notelp']);
    $user_email 		= mysqli_real_escape_string($koneksi, $_POST['email']);
    $user_alamat		= mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $user_password 		= mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirmpassword 	= mysqli_real_escape_string($koneksi, $_POST['confirmpassword']);

    // Validasi password
    if ($user_password !== $confirmpassword) {
        echo "
           <script>
              alert('Sandi yang anda masukkan tidak sama harap ulangi lagi');
              window.location = 'user.php';
           </script>
           ";
        exit();
    }

    // Enkripsi password sebelum disimpan ke database
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    date_default_timezone_set("Asia/Jakarta");
    $tgl_input = date("Y-m-d");
	$waktu_input = date('j F Y H:i:s');

    if ($_FILES['foto']['name'] != '') {
        $uploadDir = "../gambar/user/";
        $uploadFile = $uploadDir . basename($_FILES['foto']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        $allowedExtensions = array("png", "jpg", "jpeg");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "
                <script>
                alert('Gambar yang anda upload tidak sesuai ketentuan Format');
                window.location = 'user.php';
                </script>
                ";
            exit();
        }

        if ($_FILES['foto']['size'] > 10 * 1024 * 1024) {
            echo "
                <script>
                alert('Gambar yang anda upload tidak sesuai dengan ukuran yang telah ditentukan');
                window.location = 'user.php';
                </script>
                ";
            exit();
        }

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
            $sql = "INSERT INTO user (user_nip, user_nama, user_notelp, user_email, user_alamat, user_password, user_foto) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $user_nip, $user_nama, $user_notelp, $user_email, $user_alamat, $hashed_password, $uploadFile);

            if (mysqli_stmt_execute($stmt)) {
                echo "
                <script>
                alert('Data Anda berhasil disimpan dengan NIP $user_nip pada tanggal $waktu_input');
                window.location = 'user.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Mohon Cek Kembali Data Yang Anda Masukkan!');
                window.location = 'user.php';
                </script>
                ";
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        $sql = "INSERT INTO user (user_nip, user_nama, user_notelp, user_email, user_alamat, user_password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $user_nip, $user_nama, $user_notelp, $user_email, $user_alamat, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                alert('Data Anda berhasil disimpan dengan NIP $user_nip pada tanggal $waktu_input');
                window.location = 'user.php';
                </script>
            ";
        } else {
            echo "
                <script>
                alert('Mohon Cek Kembali Data Yang Anda Masukkan!');
                window.location = 'user.php';
                </script>
            ";
        }

        mysqli_stmt_close($stmt);
    }

    $koneksi->close();
}