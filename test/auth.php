<?php
class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        session_start();
    }

    public function register($username, $password, $role) {
        // Check if user exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if($stmt->fetch()) {
            return ['error' => 'Username already exists'];
        }
        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if($stmt->execute([$username, $hash, $role])) {
            return ['success' => 'Registration successful'];
        }
        return ['error' => 'Registration failed'];
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return ['success' => 'Login successful', 'role' => $user['role']];
        }
        return ['error' => 'Invalid username or password'];
    }

    public function check() {
        return isset($_SESSION['user_id']);
    }

    public function user() {
        if($this->check()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }

    public function logout() {
        session_destroy();
    }
}
?>
