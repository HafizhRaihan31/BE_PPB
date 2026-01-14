<?php
header("Content-Type: application/json");
include "config.php";

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
  echo json_encode(["success" => false]);
  exit;
}

$sql = "SELECT 
          id,
          total,
          paket,
          kota_asal,
          kota_tujuan,
          tanggal,
          detail
        FROM transaksi
        WHERE user_id = ?
        ORDER BY tanggal DESC";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

echo json_encode([
  "success" => true,
  "data" => $data
]);
