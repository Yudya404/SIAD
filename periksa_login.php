<?php
// Menggabungkan dengan koneksi
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip 		= mysqli_real_escape_string($koneksi, $_POST['nip']);
    $password 	= mysqli_real_escape_string($koneksi, $_POST['password']);
    $akses 		= mysqli_real_escape_string($koneksi, $_POST['akses']);

    // Cek tabel berdasarkan akses
    if ($akses == "user") {
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_nip='$nip'");
        $password_column = 'user_password'; // Nama kolom kata sandi di tabel user
    } elseif ($akses == "petugas") {
        $login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE petugas_nip='$nip'");
        $password_column = 'petugas_password'; // Nama kolom kata sandi di tabel petugas
    } elseif ($akses == "admin") {
        $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_nip='$nip'");
        $password_column = 'admin_password'; // Nama kolom kata sandi di tabel admin
    }

    if (mysqli_num_rows($login) > 0) {
        $data = mysqli_fetch_assoc($login);
        $storedPassword = $data[$password_column]; // Menggunakan nama kolom kata sandi yang sesuai

        if (password_verify($password, $storedPassword)) {
            session_start();
            $_SESSION['id'] = $data[$akses . '_id'];
            $_SESSION['nama'] = $data[$akses . '_nama'];
            $_SESSION['nip'] = $data[$akses . '_nip'];
            $_SESSION['status'] = $akses . '_login';

            if ($akses == "user") {
                echo "
                    <script>
                        alert('NIP $nip Berhasil Login.');
                        window.location = 'user/';
                    </script>
                ";
            } elseif ($akses == "petugas") {
                echo "
                    <script>
                        alert('NIP $nip Berhasil Login.');
                        window.location = 'petugas/';
                    </script>
                ";
            } elseif ($akses == "admin") {
                echo "
                    <script>
                        alert('NIP $nip Berhasil Login.');
                        window.location = 'admin/';
                    </script>
                ";
            }
        } else {
            // Password salah
            header("location:index.php?alert=password_salah");
        }
    } else {
        // NIP salah
        header("location:index.php?alert=nip_salah");
    }
}