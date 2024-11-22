<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('location: login.html');
}
?>

<h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
<p>You are now logged in.</p>
<a href="logout.php">Logout</a>
