<?php
error_reporting(0);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../config.php";

$res = mysqli_query(
    $koneksi,
    "SELECT id, username, email, role FROM user ORDER BY id DESC"
);

$data = [];
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);
