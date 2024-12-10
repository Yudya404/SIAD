# SIAD (Sistem Informasi Arsip Digital)
An example of creating an Immigration Office Digital Archives Information System, 
using automatic file numbering according to the location (file cupboard and locker) along with the file number itself.

#Fitur Utama
- File numbering automatically follows the location (cupboard and locker) along with the file number.
- GET / File  : Mendapatkan daftar berkas/ List File.
- POST / File  : Menambahkan Berkas baru/ Created File.
- GET /FIle by id  : Mendapatkan detail File berdasarkan ID.
- PUT / File : Memperbarui File/ Update File.
- DELETE /FIle  : Menghapus File / Delete File.

# Link Akses
- http://localhost/SIAD/

#Prasyarat Sistem
Sebelum menjalankan aplikasi ini, pastikan Anda telah menginstal perangkat berikut:

MariaDB/MySQL: Versi 10.4.32-MariaDB Database untuk menyimpan data product.
PHP Versi 7.2/Xampp versi 3.30

#Instalasi dan Menjalankan Aplikasi

1. Konfigurasi Variabel Lingkungan
Pastikan Program SIAD telah ada atau berada dalam file xampp/htdocs

2. Menjalankan Aplikasi Tanpa Docker (Opsional)
2.1. Setelah install Xampp, Jalankan Klik start pada apache dan Mysql.
 
2.2. Buat Database di MariaDB/MySQL
- Sebelum menjalankan aplikasi, buat database di MariaDB atau MySQL.
- Lalu Import database yang telah tersedia

3. Menjalankan Aplikasi dengan Docker (Disarankan)
3.1. Akses link Berikut di browser (Chrome atau mozila) http://localhost/SIAD/
3.2. Lalu Login Sesuai dengan usernya.

Note :
Pada saat Menjalankan Program jangan lupa import dahulu database.

Lisensi
Aplikasi ini dilisensikan di bawah MIT License.
