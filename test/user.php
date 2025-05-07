<?php
require 'config.php';
require 'Auth.php';
require 'Booking.php';

$auth = new Auth($pdo);
if(!$auth->check() || $auth->user()['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$booking = new Booking($pdo);
$message = null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lapangan = $_POST['lapangan'] ?? '';
    $date = $_POST['booking_date'] ?? '';
    $time = $_POST['booking_time'] ?? '';

    if($lapangan && $date && $time) {
        $result = $booking->createBooking($auth->user()['id'], $lapangan, $date, $time);
        if(isset($result['success'])) {
            $message = '<p style="color:green;">'.$result['success'].'</p>';
        } else {
            $message = '<p style="color:red;">'.$result['error'].'</p>';
        }
    } else {
        $message = '<p style="color:red;">All fields are required</p>';
    }
}

$userBookings = $booking->getUserBookings($auth->user()['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - Booking</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 600px; margin: auto;}
        form { margin-bottom: 30px; }
        label, select, input { display: block; margin: 10px 0; width: 100%; padding: 8px;}
        input[type="submit"] { width: auto; background: #4CAF50; color: white; border: none; cursor: pointer; padding: 10px;}
        input[type="submit"]:hover { background: #45a049;}
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px;}
        th { background: #2196F3; color: white;}
        a.logout { float: right; text-decoration: none; color: red; }
    </style>
</head>
<body>
    <h1>User Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($auth->user()['username']); ?> | <a href="logout.php" class="logout">Logout</a></p>
    <h2>Book Lapangan</h2>
    <?php if($message) echo $message; ?>
    <form method="POST" action="">
        <label>Lapangan (Field):</label>
        <select name="lapangan" required>
            <option value="">Select Field</option>
            <option value="Lapangan A">Lapangan A</option>
            <option value="Lapangan B">Lapangan B</option>
            <option value="Lapangan C">Lapangan C</option>
        </select>

        <label>Booking Date:</label>
        <input type="date" name="booking_date" required min="<?php echo date('Y-m-d'); ?>">

        <label>Booking Time:</label>
        <select name="booking_time" required>
            <option value="">Select Time</option>
            <option value="08:00:00">08:00 AM</option>
            <option value="09:00:00">09:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 PM</option>
            <option value="13:00:00">01:00 PM</option>
            <option value="14:00:00">02:00 PM</option>
            <option value="15:00:00">03:00 PM</option>
            <option value="16:00:00">04:00 PM</option>
            <option value="17:00:00">05:00 PM</option>
        </select>

        <input type="submit" value="Book">
    </form>

    <h2>Your Bookings</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Lapangan</th>
            <th>Date</th>
            <th>Time</th>
            <th>Booked At</th>
        </tr>
        <?php foreach($userBookings as $b): ?>
        <tr>
            <td><?php echo $b['id']; ?></td>
            <td><?php echo htmlspecialchars($b['lapangan']); ?></td>
            <td><?php echo $b['booking_date']; ?></td>
            <td><?php echo $b['booking_time']; ?></td>
            <td><?php echo $b['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($userBookings)) echo '<tr><td colspan="5" style="text-align:center;">You have no bookings.</td></tr>' ?>
    </table>
</body>
</html>
