<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");


include "config.php";

$q = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

$data = array();
while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);
