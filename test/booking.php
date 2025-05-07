<?php
class Booking {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createBooking($user_id, $lapangan, $date, $time) {
        // Check if slot is already booked for lapangan at date/time
        $stmt = $this->pdo->prepare("SELECT * FROM bookings WHERE lapangan = ? AND booking_date = ? AND booking_time = ?");
        $stmt->execute([$lapangan, $date, $time]);
        if($stmt->fetch()) {
            return ['error' => 'This slot is already booked'];
        }
        // Insert new booking
        $stmt = $this->pdo->prepare("INSERT INTO bookings (user_id, lapangan, booking_date, booking_time) VALUES (?, ?, ?, ?)");
        if($stmt->execute([$user_id, $lapangan, $date, $time])) {
            return ['success' => 'Booking successful'];
        }
        return ['error' => 'Booking failed'];
    }

    public function getUserBookings($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM bookings WHERE user_id = ? ORDER BY booking_date DESC, booking_time DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookings() {
        $stmt = $this->pdo->query("SELECT b.*, u.username FROM bookings b JOIN users u ON b.user_id = u.id ORDER BY booking_date DESC, booking_time DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
