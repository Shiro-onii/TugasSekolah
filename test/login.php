<?php
require 'config.php';
require 'Auth.php';

$auth = new Auth($pdo);
$message = null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if($username && $password) {
        $result = $auth->login($username, $password);
        if(isset($result['success'])) {
            if($result['role'] === 'admin') {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: user.php");
                exit;
            }
        } else {
            $message = '<p style="color:red;">'.$result['error'].'</p>';
        }
    } else {
        $message = '<p style="color:red;">Please enter username and password</p>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: auto; padding: 20px; }
        label, input { display: block; margin: 10px 0; width: 100%; }
        input[type="submit"] { width: auto; padding: 10px; background: #008CBA; color: white; border: none; cursor: pointer;}
        input[type="submit"]:hover { background: #007bb5;}
    </style>
</head>
<body>
    <h2>Login</h2>
    <?php if($message) echo $message; ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
    <p>No account? <a href="register.php">Register here</a></p>
</body>
</html>
