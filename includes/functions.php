<?php
require_once __DIR__ . '/config.php';

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: /sameer_siddique/auth/login.php');
        exit;
    }
}

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Simple pagination helper
function paginate($total, $perPage, $currentPage) {
    $pages = ceil($total / $perPage);
    return [
        'pages' => $pages,
        'current' => $currentPage
    ];
}
?>
