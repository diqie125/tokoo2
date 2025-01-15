<?php
include"koneksi.php";
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM products";
$result = $koneksi->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko IndoMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Toko IndoMarket</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Produk
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" style="background-color: greenyellow;">Keranjang</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a href="logout.php" class="btn btn-danger ms-3">Logout</a>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <h1>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
      <p>Anda login sebagai <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong>.</p>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php while ($data = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="upload/<?= htmlspecialchars($data['foto']); ?>" class="card-img-top" alt="<?= htmlspecialchars($data['nama_produk']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($data['nama_produk']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($data['deskripsi']); ?></p>
                            <p class="card-text"><strong>Rp<?= number_format($data['harga'], 2, ',', '.'); ?></strong></p>
                            <a href="detailproduk.php?id=<?php echo $data['id']?>" class="btn btn-primary" style="background-color: blue; width: 130px; height: 45px;">Detail Produk</a>
                            <a href="Keranjang.php" class="btn btn-primary" style="background-color: blue; width: 200px; height: 45px; margin-top:5px">Tambah Keranjang</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
