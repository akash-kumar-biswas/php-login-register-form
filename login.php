<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php?view=login');
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    set_flash('error', 'Email and password are required.');
    redirect('index.php?view=login');
}

try {
    $stmt = $pdo->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        set_flash('error', 'Invalid email or password.');
        redirect('index.php?view=login');
    }

    $_SESSION['user'] = [
        'id'    => $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role'],
    ];

    set_flash('success', 'Welcome back, ' . $user['name'] . '!');
    if ($user['role'] === 'admin') {
        redirect('admin.php');
    } else {
        redirect('dashboard.php');
    }

} catch (Throwable $e) {
    set_flash('error', 'Login failed. Please try again.');
    redirect('index.php?view=login');
}
