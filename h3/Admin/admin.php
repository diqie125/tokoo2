<?php
session_start();

// Cek apakah sudah login dan role-nya admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#users">Kelola Pengguna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#settings">Pengaturan</a>
            </li>
          </ul>
          <a href="../logout.php" class="btn btn-danger ms-3">Logout</a>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
      <h1 class="text-center">Selamat Datang, Admin <?php echo ($_SESSION['username']); ?>!</h1>
      <p class="text-center">Anda login sebagai <strong><?php echo ($_SESSION['role']); ?></strong>.</p>

      <!-- Dashboard Cards -->
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card text-bg-primary mb-3">
            <div class="card-body">
              <h5 class="card-title">Pengguna</h5>
              <p class="card-text">Kelola data pengguna di sistem.</p>
              <a href="#users" class="btn btn-light">Kelola Pengguna</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-bg-success mb-3">
            <div class="card-body">
              <h5 class="card-title">Laporan</h5>
              <p class="card-text">Lihat laporan sistem secara real-time.</p>
              <a href="#reports" class="btn btn-light">Lihat Laporan</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-bg-warning mb-3">
            <div class="card-body">
              <h5 class="card-title">Pengaturan</h5>
              <p class="card-text">Atur sistem sesuai kebutuhan.</p>
              <a href="#settings" class="btn btn-light">Buka Pengaturan</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card text-bg-primary mb-3">
            <div class="card-body">
              <h5 class="card-title">Produk</h5>
              <p class="card-text">Kelola data produk.</p>
              <a href="../Admin/kelola_produk.php" class="btn btn-light">Kelola Produk</a>
            </div>
          </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

