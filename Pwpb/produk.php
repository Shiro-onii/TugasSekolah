<?php
session_start();
require 'connection.php';

$username = isset($_GET['username']) ? htmlspecialchars(trim($_GET['username'])) : '';

$product_name = "Smartphone XYZ";
$price_per_unit = 3000000; // price in IDR

$show_thanks = false;
$purchase_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username_post = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
  $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
  $quantity = max(1, $quantity);
  $total = $price_per_unit * $quantity;
  $purchase_date = date('Y-m-d H:i:s');

  if ($username_post) {
    $stmt = $conn->prepare("INSERT INTO purchases (username, product_name, purchase_date, total) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username_post, $product_name, $purchase_date, $total);
    $stmt->execute();
    $purchase_id = $stmt->insert_id;
    $stmt->close();
    $show_thanks = true;
  }
} else {
  // First show form, get username from GET param or empty
  $quantity = 1;
  $total = $price_per_unit * $quantity;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk dan Pembelian</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(120deg, #89f7fe, #66a6ff);
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
    }
    .container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      max-width: 430px;
      width: 100%;
      padding: 2rem 1.5rem;
      text-align: center;
    }
    h1 {
      font-family: 'Courier New', Courier, monospace;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }
    .welcome {
      font-size: 1.2rem;
      color: #222;
      margin-bottom: 1.8rem;
    }
    .product-name {
      font-weight: bold;
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
      color: #007BFF;
    }
    .price {
      font-size: 1.1rem;
      margin-bottom: 1rem;
      color: #333;
    }
    .purchase-date {
      margin-bottom: 1.3rem;
      color: #555;
      font-style: italic;
    }
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
      font-size: 1.1rem;
    }
    input[type="number"] {
      width: 100%;
      padding: 0.6rem;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 1rem;
      text-align: center;
      /* -moz-appearance:textfield; */
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none;
      margin: 0; 
    }
    .total {
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #222;
    }
    button {
      background-color: #007BFF;
      border: none;
      color: white;
      padding: 0.75rem 1.5rem;
      font-size: 1.1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    button:hover:not(:disabled) {
      background-color: #0056b3;
    }
    .thankyou {
      font-size: 1.3rem;
      font-weight: bold;
      color: #228B22;
      margin-bottom: 1rem;
    }
    a {
      display: inline-block;
      margin-top: 1rem;
      color: #007BFF;
      text-decoration: none;
      font-weight: 600;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
  <script>
    function updateTotal() {
      const pricePerUnit = <?php echo $price_per_unit; ?>;
      let qtyInput = document.getElementById('quantity');
      let totalDisplay = document.getElementById('totalDisplay');
      let qty = parseInt(qtyInput.value) || 1;
      if (qty < 1) qty = 1;
      let total = pricePerUnit * qty;
      totalDisplay.textContent = "Total Pembelian: Rp " + total.toLocaleString('id-ID');
    }
    window.addEventListener('DOMContentLoaded', function() {
      const qtyInput = document.getElementById('quantity');
      qtyInput.addEventListener('input', updateTotal);
      updateTotal();
    });
  </script>
</head>
<body>
  <div class="container">
    <?php if ($show_thanks): ?>
      <div class="thankyou">Terimakasih sudah berbelanja, <?php echo htmlspecialchars($username_post); ?>!</div>
      <a href="data.php">Lihat Data Pembelian</a>
    <?php else: ?>
      <h1>Selamat datang, <?php echo $username ? htmlspecialchars($username) : "Tamu"; ?>!</h1>
      <div class="product-name"><?php echo $product_name; ?></div>
      <div class="price">Harga per unit: Rp <?php echo number_format($price_per_unit,0,",","."); ?></div>
      <div class="purchase-date">Tanggal Pembelian: <?php echo date('d-m-Y H:i:s'); ?></div>

      <form method="POST" action="produk.php">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>" />
        <label for="quantity">Jumlah Beli:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" min="1" required />
        <div class="total" id="totalDisplay">Total Pembelian: Rp <?php echo number_format($total,0,",","."); ?></div>
        <button type="submit">Send</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
