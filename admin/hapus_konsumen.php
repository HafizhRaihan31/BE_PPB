<?php
error_reporting(0);
header("Content-Type: application/json");
require_once "../config.php";

$id = $_POST['id'];

$koneksi->query("DELETE FROM user WHERE id='$id'");

echo json_encode(["success" => true]);
