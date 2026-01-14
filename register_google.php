<?php
// ⛔ MATIKAN SEMUA OUTPUT ERROR HTML
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

// JSON ONLY
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "config.php";

// Ambil POST dengan aman
$uid   = $_POST['firebase_uid'] ?? null;
$email = $_POST['email'] ?? '';
$nama  = $_POST['username'] ?? '';

if ($uid === null || $uid === '') {
    echo json_encode([
        "status" => "error",
        "message" => "firebase_uid kosong"
    ]);
    exit;
}

// CEK USER
$stmt = $koneksi->prepare(
    "SELECT id, username, email, role FROM user WHERE firebase_uid = ?"
);

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Prepare gagal"
    ]);
    exit;
}

$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();

// INSERT JIKA BELUM ADA
if ($result->num_rows === 0) {
    $insert = $koneksi->prepare(
        "INSERT INTO user (firebase_uid, username, email, role)
         VALUES (?, ?, ?, 'user')"
    );

    if (!$insert) {
        echo json_encode([
            "status" => "error",
            "message" => "Prepare insert gagal"
        ]);
        exit;
    }

    $insert->bind_param("sss", $uid, $nama, $email);
    $insert->execute();
}

// AMBIL USER (PASTI ADA)
$get = $koneksi->prepare(
    "SELECT id, username, email, role FROM user WHERE firebase_uid = ?"
);

$get->bind_param("s", $uid);
$get->execute();
$user = $get->get_result()->fetch_assoc();

if (!$user) {
    echo json_encode([
        "status" => "error",
        "message" => "User tidak ditemukan"
    ]);
    exit;
}

// ✅ RESPONSE JSON BERSIH
echo json_encode([
    "status" => "success",
    "user" => $user
]);
