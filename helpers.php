<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function set_flash(string $key, string $message): void {
    $_SESSION['_flash'][$key] = $message;
}

function get_flash(string $key): ?string {
    if (!isset($_SESSION['_flash'][$key])) return null;
    $msg = $_SESSION['_flash'][$key];
    unset($_SESSION['_flash'][$key]);
    return $msg;
}

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
