<?php
session_start();
include "koneksi.php"; // pastikan koneksi.php sudah terhubung dengan benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form registrasi
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user'; // Secara default, role pengguna baru adalah 'user'

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = $koneksi->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Jika email sudah terdaftar
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Query untuk menyimpan data registrasi
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
        
        if ($koneksi->query($sql) === TRUE) {
            echo "Registrasi berhasil! Silakan <a href='login.php'>login</a>.";
        } else {
            echo "Terjadi kesalahan: " . $koneksi->error;
        }
    }
}

$koneksi->close();
?>
