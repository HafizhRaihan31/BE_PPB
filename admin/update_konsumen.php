<?php
error_reporting(0);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../config.php";

$id       = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$email    = $_POST['email'] ?? '';
$role     = $_POST['role'] ?? 'user';

if ($id == '') {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $koneksi->prepare(
    "UPDATE user SET username=?, email=?, role=? WHERE id=?"
);
$stmt->bind_param("sssi", $username, $email, $role, $id);
$stmt->execute();

echo json_encode(["success" => true]);
