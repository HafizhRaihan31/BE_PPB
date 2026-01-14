<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "../config.php";

$id = $_POST['id'] ?? 0;
$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$harga = $_POST['harga'] ?? 0;
$gambar = $_POST['gambar'] ?? '';

mysqli_query($koneksi,
    "UPDATE produk SET
     nama='$nama',
     deskripsi='$deskripsi',
     harga='$harga',
     gambar='$gambar'
     WHERE id='$id'"
);

echo json_encode(["success"=>true]);
