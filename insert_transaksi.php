<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

error_reporting(0);
ini_set('display_errors', 0);

include "config.php";

// ================= INPUT =================
$user_id     = $_POST['user_id'] ?? '';
$total       = $_POST['total'] ?? '';
$paket       = $_POST['paket'] ?? '';
$kota_asal   = $_POST['kota_asal'] ?? '';
$kota_tujuan = $_POST['kota_tujuan'] ?? '';
$detail      = $_POST['items'] ?? '';
$bukti       = $_POST['bukti'] ?? '';

if ($user_id === '' || $total === '' || $bukti === '') {
    echo json_encode([
        "success" => false,
        "error" => "Data tidak lengkap"
    ]);
    exit;
}

// ================= SIMPAN FILE =================
$folder = "bukti/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// VALIDASI BASE64
$bukti = str_replace(' ', '+', $bukti);
$decoded = base64_decode($bukti, true);

if ($decoded === false) {
    echo json_encode([
        "success" => false,
        "error" => "Format bukti tidak valid"
    ]);
    exit;
}

$namaFile = "bukti_" . time() . ".png";
$filePath = $folder . $namaFile;

if (file_put_contents($filePath, $decoded) === false) {
    echo json_encode([
        "success" => false,
        "error" => "Gagal menyimpan file bukti"
    ]);
    exit;
}

// ================= INSERT DATABASE =================
$sql = "INSERT INTO transaksi
(user_id, total, paket, kota_asal, kota_tujuan, detail, bukti)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($koneksi)
    ]);
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "idsssss",
    $user_id,
    $total,
    $paket,
    $kota_asal,
    $kota_tujuan,
    $detail,
    $filePath
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "error" => mysqli_stmt_error($stmt)
    ]);
}

