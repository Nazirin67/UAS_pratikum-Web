<?php
$servername = "localhost"; // Ganti dengan server database Anda, "localhost" untuk server lokal
$username = "article";        // Ganti dengan username database Anda
$password = "YES";            // Ganti dengan password database Anda
$dbname = "designblog-starter"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil";
?>
