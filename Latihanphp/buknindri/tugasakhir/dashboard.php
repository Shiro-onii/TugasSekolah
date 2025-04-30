<?php
// dashboard.php
session_start();

// Cek jika user belum login, redirect ke login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'connect.php';

$pesan = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];
    $user = $_SESSION['user'];

    // Simpan data transaksi ke database
    $query = "INSERT INTO transaksi (nama_user, tanggal, total) VALUES ('$user', '$tanggal', '$total')";

    if (mysqli_query($conn, $query)) {
        $pesan = "Terima kasih sudah berbelanja!";
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
    body {
        background: #e0f7fa; /* Biru langit muda */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center; /* Center horizontal */
        align-items: center;    /* Center vertical */
        flex-direction: column;
    }

    .dashboard-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 400px;
    }

    h2 {
        color: #0288d1; /* Biru langit */
        margin-bottom: 20px;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        text-align: left;
        margin-bottom: 6px;
        color: #0288d1;
        font-weight: bold;
    }

    input[type="date"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #b2ebf2;
        border-radius: 6px;
        background-color: #f0fbff;
        font-size: 16px;
    }

    button {
        width: 100%;
        background-color: #03a9f4;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #0288d1;
    }

    p {
        margin-top: 20px;
        color: #006064;
        font-weight: bold;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #03a9f4;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <h2>Selamat datang di website, <?php echo $_SESSION['user']; ?></h2>

    <form method="POST">
        <label>Tanggal Pembelian:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Total Pembelian:</label><br>
        <input type="number" name="total" required><br><br>

        <button type="submit">Kirim</button>
    </form>

    <?php if ($pesan != ""): ?>
        <p><strong><?php echo $pesan; ?></strong></p>
        <a href="index.php">Ulangi Input</a>
    <?php endif; ?>
</body>
</html>
