<?php
require_once __DIR__ . '/helpers.php';
$view = $_GET['view'] ?? 'login';
$success = get_flash('success');
$error   = get_flash('error');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Stack Login and Register Form | Akash Biswas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <?php if ($success): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <div class="form-box <?= $view === 'login' ? 'active' : '' ?>" id="login-form">
            <form action="login.php" method="POST" novalidate>
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account?
                   <a href="?view=register" onclick="event.preventDefault();showForm('register-form');history.replaceState(null,'','?view=register');">
                       Register
                   </a>
                </p>
            </form>
        </div>

        <div class="form-box <?= $view === 'register' ? 'active' : '' ?>" id="register-form">
            <form action="register.php" method="POST" novalidate>
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password (min 6 chars)" required>
                <select name="role" required>
                    <option value=""> Select Role </option>
                    <option value="user"> User </option>
                    <option value="admin"> Admin </option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account?
                   <a href="?view=login" onclick="event.preventDefault();showForm('login-form');history.replaceState(null,'','?view=login');">
                       Login
                   </a>
                </p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="show-form.js"></script>
</body>
</html>
