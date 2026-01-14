<?php
include 'config.php';

$q = mysqli_query($koneksi, "SELECT * FROM produk");
$data = [];

while($row = mysqli_fetch_assoc($q)){
  $data[] = $row;
}

echo json_encode($data);
