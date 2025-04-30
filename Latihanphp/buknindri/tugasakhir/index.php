<?php
// index.php

session_start();

// Jika user sudah login, redirect ke dashboard
// if (isset($_SESSION['user'])) {
//     header("Location: dashboard.php");
//     exit();
// }

header("Location: login.php");
exit();
?>
