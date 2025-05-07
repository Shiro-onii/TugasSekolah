<?php
require 'config.php';
require 'Auth.php';
require 'Booking.php';

$auth = new Auth($pdo);
if(!$auth->check() || $auth->user()['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$booking = new Booking($pdo);
$allBookings = $booking->getAllBookings();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px;}
        th, td { border: 1px solid #ddd; padding: 8px;}
        th { background: #4CAF50; color: white; }
        a.logout { float: right; margin-top: 10px; text-decoration: none; color: red;}
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($auth->user()['username']); ?> | <a href="logout.php" class="logout">Logout</a></p>
    <h2>All Bookings</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Field (Lapangan)</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
            <th>Booking Created At</th>
        </tr>
        <?php foreach($allBookings as $b): ?>
        <tr>
            <td><?php echo $b['id']; ?></td>
            <td><?php echo htmlspecialchars($b['username']); ?></td>
            <td><?php echo htmlspecialchars($b['lapangan']); ?></td>
            <td><?php echo $b['booking_date']; ?></td>
            <td><?php echo $b['booking_time']; ?></td>
            <td><?php echo $b['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($allBookings)) echo '<tr><td colspan="6" style="text-align:center;">No bookings found</td></tr>' ?>
    </table>
</body>
</html>
