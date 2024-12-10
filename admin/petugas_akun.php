<?php
session_start(); // Pastikan session sudah dimulai

require_once('../koneksi.php'); // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['nip']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['password'])) {
    $petugas_id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $petugas_nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $new_password = mysqli_real_escape_string($koneksi, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); // Menggunakan $_POST['password'] untuk password lama

    // Lakukan pengecekan password lama
    $password_query = "SELECT petugas_password FROM petugas WHERE petugas_id = ?";
    $stmt_password = mysqli_prepare($koneksi, $password_query);
    mysqli_stmt_bind_param($stmt_password, "s", $petugas_id);
    mysqli_stmt_execute($stmt_password);
    $result = mysqli_stmt_get_result($stmt_password);
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['petugas_password'];

    if (password_verify($password, $hashed_password)) {
        // Hash kata sandi baru sebelum menyimpannya dalam database
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Lakukan update password dalam database
        $update_query = "UPDATE petugas SET petugas_password = ? WHERE petugas_id = ?";
        $stmt_update = mysqli_prepare($koneksi, $update_query);
        mysqli_stmt_bind_param($stmt_update, "ss", $hashed_new_password, $petugas_id);
        $result = mysqli_stmt_execute($stmt_update);

        if ($result) {
            // Password berhasil diperbarui
            $successMessage = "Kata sandi akun dengan NIP $petugas_nip berhasil diperbarui.";
            echo "
                <script>
                alert('$successMessage');
                window.location = 'petugas.php';
                </script>
            ";
        } else {
            // Gagal memperbarui kata sandi
            $errorMessage = "Kata sandi akun dengan NIP $petugas_nip Gagal diperbarui.";
            echo "
                <script>
                alert('$errorMessage');
                window.location = 'petugas.php';
                </script>
            ";
        }
    } else {
        // Password lama tidak sesuai
        $errorMessage = "Kata sandi lama akun dengan NIP $petugas_nip tidak sesuai.";
        echo "
            <script>
            alert('$errorMessage');
            window location = 'petugas.php';
            </script>
        ";
    }

    // Tutup prepared statements
    mysqli_stmt_close($stmt_password);
    mysqli_stmt_close($stmt_update);
} else {
    // Akses tidak sah
    $errorMessage = "Akses tidak sah.";
    echo "
        <script>
        alert('$errorMessage');
        window location = '../index.php';
        </script>
    ";
}

// Tutup koneksi database
mysqli_close($koneksi);
