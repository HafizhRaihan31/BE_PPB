<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "../config.php";

$id = $_POST['id'] ?? 0;

mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");

echo json_encode(["success"=>true]);
