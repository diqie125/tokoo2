<?php
session_start();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color:rgb(94, 94, 247);
        }
        .login-container {
            width: 300px;
            padding: 20px;
            background-color: rgb(253, 253, 253);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
 <div>
 <iframe src="https://giphy.com/embed/GwOVvsMGbU0dG" width="480" height="274" ></iframe>
 </div>
    <div class="login-container">
        <h3 class="text-center mb-4">Login</h3>
        <form action="p_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="registrasi.php">Daftar</a>
        </form>
    </div>

</body>
</html>
