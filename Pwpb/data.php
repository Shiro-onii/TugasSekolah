<?php
require 'connection.php';

$sql = "SELECT id, username, product_name, purchase_date, total FROM purchases ORDER BY purchase_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Pembelian</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      min-height: 100vh;
      margin: 0;
      padding: 1rem;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }
    .container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      max-width: 700px;
      width: 100%;
      padding: 1.5rem 1rem;
    }
    h1 {
      margin-bottom: 1rem;
      color: #007BFF;
      text-align: center;
      font-weight: 700;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 1rem;
    }
    th, td {
      padding: 0.65rem 0.8rem;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #007BFF;
      color: white;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f1faff;
    }
    .back-link {
      display: block;
      margin-top: 1rem;
      text-align: center;
    }
    .back-link a {
      text-decoration: none;
      color: #007BFF;
      font-weight: 600;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
    @media(max-width: 600px) {
      th, td {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Data Pembelian</h1>
    <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Produk</th>
          <th>Tanggal Pembelian</th>
          <th>Total (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
            <td><?php echo date('d-m-Y H:i:s', strtotime($row['purchase_date'])); ?></td>
            <td><?php echo number_format($row['total'],0,",","."); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p>Tidak ada data pembelian.</p>
    <?php endif; ?>
    <div class="back-link"><a href="index.php">Kembali ke Form</a></div>
  </div>
</body>
</html>
        