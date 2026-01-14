<?php
include 'config.php';

$id       = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($id === '' || $username === '' || $password === '') {
    echo json_encode(["success" => false, "error" => "Data tidak lengkap"]);
    exit;
}

$stmt = $koneksi->prepare(
    "UPDATE user SET username = ?, password = ? WHERE id = ?"
);

$stmt->bind_param("ssi", $username, $password, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "error" => "ID tidak ditemukan / data sama"
    ]);
}
