<?php
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "tokoo"; // Sesuaikan dengan nama database Anda

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
