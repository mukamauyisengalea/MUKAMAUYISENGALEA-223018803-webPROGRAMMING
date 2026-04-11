<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon Hotel | Luxury Redefined</title>
    <meta name="description" content="Experience world-class luxury at Grand Horizon Hotel. Book your stay, explore our gourmet menu, and more.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="nav-container">
            <a href="index.php" class="logo">Grand Horizon</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="order.php">Order</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php if(isset($_SESSION['admin_logged_in'])): ?>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div id="toast"></div>
