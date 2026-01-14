<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "../config.php";

$res = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

$data = [];
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);
