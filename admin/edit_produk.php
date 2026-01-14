<?php
error_reporting(0);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../config.php";

$id = $_POST['id'] ?? '';
$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$harga = $_POST['harga'] ?? '';

if ($id === '' || $nama === '' || $harga === '') {
    echo json_encode(["success"=>false,"error"=>"Data tidak lengkap"]);
    exit;
}

// JIKA ADA GAMBAR BARU
// JIKA ADA GAMBAR BARU
if (
    isset($_FILES['gambar']) &&
    $_FILES['gambar']['error'] === UPLOAD_ERR_OK
) {
    $folder = __DIR__ . "/../gambar/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
    $target = $folder . $namaFile;

    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        echo json_encode([
            "success" => false,
            "error" => "Gagal menyimpan file gambar"
        ]);
        exit;
    }

    // UPDATE DENGAN GAMBAR
    $stmt = $koneksi->prepare(
        "UPDATE produk
         SET nama=?, deskripsi=?, harga=?, gambar=?
         WHERE id=?"
    );
    $stmt->bind_param("ssisi", $nama, $deskripsi, $harga, $namaFile, $id);

} else {

    // UPDATE TANPA GANTI GAMBAR
    $stmt = $koneksi->prepare(
        "UPDATE produk
         SET nama=?, deskripsi=?, harga=?
         WHERE id=?"
    );
    $stmt->bind_param("ssii", $nama, $deskripsi, $harga, $id);
}

$stmt->execute();

echo json_encode([
    "success" => true
]);


$stmt->execute();

echo json_encode([
    "success" => true,
    "message" => "Produk berhasil diupdate"
]);

