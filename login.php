<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

include "config.php";

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    echo json_encode([
        "success" => false,
        "error" => "Username / password kosong"
    ]);
    exit;
}

$stmt = $koneksi->prepare(
    "SELECT id, username, email, role
     FROM `user`
     WHERE username = ? AND password = ?
     LIMIT 1"
);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "error" => $koneksi->error
    ]);
    exit;
}

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->bind_result($id, $uname, $email, $role);

if ($stmt->fetch()) {
    echo json_encode([
        "success" => true,
        "data" => [
            "id" => (int)$id,
            "username" => $uname,
            "email" => $email,
            "role" => $role
        ]
    ]);
} else {
    echo json_encode([
        "success" => false,
        "error" => "Username atau password salah"
    ]);
}

$stmt->close();
$koneksi->close();

