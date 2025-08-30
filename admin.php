<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';
require_role('admin');
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body style="display:block; min-height:auto; padding:30px;">
  <h2>Admin Panel</h2>
  <p>Welcome, <?= e($user['name']) ?>.</p>
  <p><a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
