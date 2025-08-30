<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php?view=register');
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$role     = 'user';

if ($name === '' || $email === '' || $password === '') {
    set_flash('error', 'All fields are required.');
    redirect('index.php?view=register');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('error', 'Please enter a valid email.');
    redirect('index.php?view=register');
}
if (strlen($password) < 6) {
    set_flash('error', 'Password must be at least 6 characters.');
    redirect('index.php?view=register');
}

try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        set_flash('error', 'Email is already registered.');
        redirect('index.php?view=register');
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$name, $email, $password_hash, $role]);

    set_flash('success', 'Registration successful! You can now log in.');
    redirect('index.php?view=login');

} catch (Throwable $e) {
    set_flash('error', 'Registration failed. Please try again.');
    redirect('index.php?view=register');
}
