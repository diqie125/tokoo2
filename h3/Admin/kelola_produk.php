<?php
session_start();
include "../koneksi.php";

// Cek apakah sudah login dan role-nya admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Tambah Produk
if (isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Upload file
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $upload = 'upload/';
    move_uploaded_file($tmp, $upload . $foto);

    $sql = "INSERT INTO products (nama_produk, deskripsi, foto, harga) VALUES ('$nama_produk', '$deskripsi', '$foto', '$harga')";
    $koneksi->query($sql);
}

// Edit Produk
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $upload = 'upload/';
        move_uploaded_file($tmp, $upload. $foto);

        $sql = "UPDATE products SET nama_produk='$nama_produk', deskripsi='$deskripsi', foto='$foto', harga='$harga' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga' WHERE id='$id'";
    }

    $koneksi->query($sql);
}

// Hapus Produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM products WHERE id='$id'";
    $koneksi->query($sql);
    header("Location: kelola_produk.php");
}

// Ambil semua data produk
$sql = "SELECT * FROM products";
$result = $koneksi->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Kelola Produk</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk</button>

        <!-- Tabel Produk -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td><img src="upload/<?= htmlspecialchars($row['foto']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>" style="width: 100px;"></td>
                            <td>Rp<?= number_format($row['harga'], 2, ',', '.'); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?= $row['id']; ?>" 
                                    data-nama_produk="<?= htmlspecialchars($row['nama_produk']); ?>" 
                                    data-deskripsi="<?= htmlspecialchars($row['deskripsi']); ?>" 
                                    data-harga="<?= $row['harga']; ?>"
                                    data-foto="<?= htmlspecialchars($row['foto']); ?>"
                                    data-bs-toggle="modal" data-bs-target="#modalEdit">Edit</button>
                                <a href="?hapus=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada produk</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="edit-nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="edit-foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="edit-harga" name="harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="edit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Isi data modal edit
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('edit-id').value = this.getAttribute('data-id');
                document.getElementById('edit-nama_produk').value = this.getAttribute('data-nama_produk');
                document.getElementById('edit-deskripsi').value = this.getAttribute('data-deskripsi');
                document.getElementById('edit-harga').value = this.getAttribute('data-harga');
            });
        });
    </script>
</body>
</html>
