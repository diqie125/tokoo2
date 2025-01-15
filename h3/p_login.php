<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Query untuk memeriksa user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User ditemukan
        $row = $result->fetch_assoc();

        // Verifikasi password hash
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            session_regenerate_id(true);

            // Redirect berdasarkan role
            if ($row['role'] === 'admin') {
                header("Location: Admin/admin.php");
            } else {
                header("Location: user.php");
            }
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }

    $stmt->close();
}

$koneksi->close();
?>
