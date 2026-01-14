<?php
require_once "../config.php";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=laporan_penjualan.csv");

$output = fopen("php://output", "w");
fputcsv($output, ["Tanggal", "Username", "Total", "Paket"]);

$q = $koneksi->query("
  SELECT t.tanggal, u.username, t.total, t.paket
  FROM transaksi t
  JOIN user u ON t.user_id = u.id
");

while ($row = $q->fetch_assoc()) {
  fputcsv($output, $row);
}

fclose($output);
