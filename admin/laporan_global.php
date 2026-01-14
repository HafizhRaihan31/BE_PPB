<?php
include "../config.php";

$data = $koneksi->query("
  SELECT t.id, u.username, t.total, t.paket, t.tanggal
  FROM transaksi t
  JOIN user u ON t.user_id = u.id
  ORDER BY t.tanggal DESC
");

$grandTotal = 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Penjualan Global</title>
  <style>
    body { font-family: Arial; }
    table { width:100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border:1px solid #000; padding:8px; }
    th { background:#eee; }
    .total-row {
      font-weight: bold;
      background: #f0f0f0;
    }
  </style>
</head>
<body onload="window.print()">

<h2>LAPORAN PENJUALAN GLOBAL</h2>

<table>
  <tr>
    <th>No</th>
    <th>Konsumen</th>
    <th>Total</th>
    <th>Paket</th>
    <th>Tanggal</th>
  </tr>

<?php $no=1; while($r=$data->fetch_assoc()): ?>
<?php $grandTotal += $r['total']; ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($r['username']) ?></td>
    <td>Rp <?= number_format($r['total'], 0, ',', '.') ?></td>
    <td><?= $r['paket'] ?: '-' ?></td>
    <td><?= $r['tanggal'] ?></td>
  </tr>
<?php endwhile; ?>

  <!-- TOTAL KESELURUHAN -->
  <tr class="total-row">
    <td colspan="2" align="center">TOTAL KESELURUHAN</td>
    <td colspan="3">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
  </tr>
</table>

</body>
</html>
