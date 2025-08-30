<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';
require_login();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body style="display:block; min-height:auto; padding:30px;">
  <h2>Hello, <?= e($user['name']) ?></h2>
  <p>You are logged in as <b><?= e($user['role']) ?></b>.</p>
  <?php if ($user['role'] === 'admin'): ?>
    <p><a href="admin.php">Go to Admin Panel</a></p>
  <?php endif; ?>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
