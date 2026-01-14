<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once __DIR__ . '/../config.php';

if (!isset($koneksi)) {
    echo json_encode([
        "status" => false,
        "error" => "Koneksi database tidak ditemukan"
    ]);
    exit;
}

$sql = "
SELECT 
    t.id,
    t.user_id,
    u.username AS nama_user,
    t.total,
    t.paket,
    t.kota_asal,
    t.kota_tujuan,
    t.tanggal,
    t.detail,
    t.bukti
FROM transaksi t
LEFT JOIN user u ON t.user_id = u.id
ORDER BY t.tanggal DESC
";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    echo json_encode([
        "status" => false,
        "error" => mysqli_error($koneksi)
    ]);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $detail = json_decode($row['detail'], true);
    if ($detail === null) $detail = [];

    $row['detail'] = $detail;

    if (!empty($row['bukti'])) {
        $row['bukti'] = "bukti/" . basename($row['bukti']);
    }

    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "data" => $data
]);
