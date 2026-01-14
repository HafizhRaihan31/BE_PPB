<?php
// Izinkan semua origin

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");


// Ambil nama file dari query parameter
$filename = $_GET['file'] ?? '';
$path = __DIR__ . '/../gambar/' . basename($filename); // sesuaikan path folder gambar

if (file_exists($path)) {
    $mime = mime_content_type($path);
    header("Content-Type: $mime");
    readfile($path);
} else {
    http_response_code(404);
    echo "File tidak ditemukan";
}
