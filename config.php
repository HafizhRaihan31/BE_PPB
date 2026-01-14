<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli(
    "localhost",     // host
    "root",          // username
    "",              // password (default XAMPP/Laragon kosong)
    "warungajib1"    // nama database
);

if ($koneksi->connect_error) {
    die("DB ERROR: " . $koneksi->connect_error);
}
