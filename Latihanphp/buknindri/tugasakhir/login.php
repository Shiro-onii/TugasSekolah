<?php
// login.php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    // Simpan nama user ke session
    $_SESSION['user'] = $nama;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
    body {
        background: #e0f7fa; /* biru langit muda */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        /* display: flex; */
        justify-content: center; /* center secara horizontal */
        align-items: center;    /* center secara vertical */
    }

    .login-container {
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #0288d1; /* biru */
        
    }

    .acak {
        text-align: center;
        /* top: 50px; */
        padding-top: 15%;
        /* margin-top: 10em; */
    }

    input[type="text"] {
        width: auto;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #b2ebf2;
        border-radius: 6px;
        background-color: #f0fbff;
        font-size: 16px;
    }

    button {
        width: 100px;
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
</style>

</head>
<body>
    <div class="acak"><h2>Login page</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <br>
        <input type="text" name="nama" placeholder="masukan nama anda"><br><br>
        <button type="submit">Send</button>
    </form></div>
</body>
</html>
