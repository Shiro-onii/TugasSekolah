<?php
// Simple registration page for admin and user
require 'config.php';
require 'Auth.php';

$auth = new Auth($pdo);
$message = null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // default user

    if($username && $password && ($role === 'admin' || $role === 'user')) {
        $result = $auth->register($username, $password, $role);
        if(isset($result['success'])) {
            $message = '<p style="color:green;">'.$result['success'].' <a href="login.php">Login here</a></p>';
        } else {
            $message = '<p style="color:red;">'.$result['error'].'</p>';
        }
    } else {
        $message = '<p style="color:red;">Please fill all fields correctly.</p>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: auto; padding: 20px; }
        label, input, select { display: block; margin: 10px 0; width: 100%; }
        input[type="submit"] { width: auto; padding: 10px; background: #4CAF50; color: white; border: none; cursor: pointer;}
        input[type="submit"]:hover { background: #45a049;}
    </style>
</head>
<body>
    <h2>Register</h2>
    <?php if($message) echo $message; ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Role:</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
