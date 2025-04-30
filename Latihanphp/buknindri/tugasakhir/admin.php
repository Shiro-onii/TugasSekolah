<?php
// admin.php
include 'connect.php';

// Ambil semua data transaksi
$query = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Transaksi</title>
    <style>
    body {
        background: #e0f7fa; /* Biru langit muda */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 40px;
    }

    h2 {
        color: #0288d1;
        margin-bottom: 30px;
    }

    table {
        width: 80%;
        max-width: 900px;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
    }

    thead {
        background-color: #03a9f4;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f1fafe;
    }

    tbody tr:hover {
        background-color: #b2ebf2;
    }

    th {
        font-weight: bold;
        font-size: 16px;
    }

    td {
        font-size: 15px;
        color: #555;
    }
</style>
a
</head>
<body>
    <h2>Daftar Transaksi</h2>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Tanggal</th>
                <th>Total Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama_user']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
