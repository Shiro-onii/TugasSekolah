<?php
// Start session to store username if needed
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Selamat Datang</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.25);
      text-align: center;
      width: 90%;
      max-width: 400px;
    }
    label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 1.2rem;
      font-weight: 600;
    }
    input[type="text"] {
      width: 100%;
      padding: 0.75rem;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 1rem;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus {
      border-color: #007BFF;
      outline: none;
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
    }
    button:hover {
      background-color: #0056b3;
    }
    .welcome-text {
      margin-top: 1rem;
      font-size: 1.5rem;
      font-family: 'Courier New', Courier, monospace; /* tipe huruf */
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <form id="welcomeForm" method="GET" action="produk.php">
      <label for="username">Masukkan Nama Anda:</label>
      <input type="text" id="username" name="username" required placeholder="Nama Anda" />
      <button type="submit">Lanjut ke Produk</button>
    </form>
  </div>
</body>
</html>
