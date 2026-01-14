<?php
include "../config.php";

$awal  = $_GET['awal'];
$akhir = $_GET['akhir'];

$data = $koneksi->query("
  SELECT t.id, u.username, t.total, t.paket, t.tanggal
  FROM transaksi t
  JOIN user u ON t.user_id = u.id
  WHERE DATE(t.tanggal) BETWEEN '$awal' AND '$akhir'
  ORDER BY t.tanggal DESC
");

$grandTotal = 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Periodik</title>
  <style>
    body { font-family: Arial; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #000; padding:8px; }
    th { background:#eee; }
    .total-row { font-weight: bold; background: #f5f5f5; }
  </style>
</head>
<body onload="window.print()">

<h2>LAPORAN PENJUALAN PERIODE</h2>
<p>tanggal : <b><?= $awal ?></b><br>
sampai tanggal : <b><?= $akhir ?></b></p>

<table>
  <tr>
    <th>No</th>
    <th>Konsumen</th>
    <th>Total</th>
    <th>Tanggal</th>
  </tr>

<?php $no=1; while($r=$data->fetch_assoc()): 
  $grandTotal += $r['total'];
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $r['username'] ?></td>
  <td>Rp <?= number_format($r['total'],0,',','.') ?></td>
  <td><?= $r['tanggal'] ?></td>
</tr>
<?php endwhile; ?>

  <!-- TOTAL PERIODE -->
  <tr class="total-row">
    <td colspan="2">TOTAL PENJUALAN PERIODE</td>
    <td colspan="2">Rp <?= number_format($grandTotal,0,',','.') ?></td>
  </tr>

</table>

</body>
</html>
