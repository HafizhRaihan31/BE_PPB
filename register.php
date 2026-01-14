<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// jika request OPTIONS (preflight) cukup stop di sini
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo json_encode([
        "success" => false,
        "message" => "exists"
    ]);
    exit();
}

$q = mysqli_query($koneksi,
    "INSERT INTO user (username, password, role) VALUES ('$username', '$password', 'user')"
);

if ($q) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
