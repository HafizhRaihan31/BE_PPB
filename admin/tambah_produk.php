<?php
error_reporting(0);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../config.php";

$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$harga = $_POST['harga'] ?? '';

if ($nama === '' || $harga === '') {
    echo json_encode(["success"=>false,"error"=>"Data tidak lengkap"]);
    exit;
}

// WAJIB ADA GAMBAR
if (!isset($_FILES['gambar'])) {
    echo json_encode(["success"=>false,"error"=>"Gambar wajib diupload"]);
    exit;
}

// SIMPAN GAMBAR
$folder = __DIR__ . "/../gambar/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$namaFile = time() . "_" . $_FILES['gambar']['name'];
move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $namaFile);

// INSERT
$stmt = $koneksi->prepare(
    "INSERT INTO produk (nama, deskripsi, harga, gambar)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param("ssis", $nama, $deskripsi, $harga, $namaFile);
$stmt->execute();

echo json_encode(["success"=>true]);

