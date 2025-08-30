<?php
require_once __DIR__ . '/helpers.php';

function require_login(): void {
    if (empty($_SESSION['user'])) {
        set_flash('error', 'Please log in to continue.');
        redirect('index.php?view=login');
    }
}

function require_role(string $role): void {
    require_login();
    if (($_SESSION['user']['role'] ?? 'user') !== $role) {
        set_flash('error', 'You do not have permission to access that page.');
        redirect('dashboard.php');
    }
}
