<?php
    session_start();
    include("koneksi.php");

    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM products WHERE id=$id");

    $data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
</head>
<body>
    <img src="upload/<?= $data['foto']?>">
    <h1><?= $data["nama_produk"]?></h1>
    <h6><?= $data["deskripsi"]?></h6>
    <p><?= $data["harga"]?></p>
</body>
</html>