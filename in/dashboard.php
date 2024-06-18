<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.html'); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
