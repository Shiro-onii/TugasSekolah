<?php
// connect.php

$host = "localhost";
$user = "root";
$pass = "";
$db = "pwpb_db";

// Membuat koneksi
$conn = mysqli_connect($host,   $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "";
}
?>
