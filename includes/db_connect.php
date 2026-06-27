<?php
// Simple procedural mysqli connection for the project
require_once __DIR__ . '/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_errno) {
    // In production you would log the error instead of exposing it
    die('Database connection failed: ' . $mysqli->connect_error);
}

// Use utf8mb4 for full Unicode support (emojis, etc.)
$mysqli->set_charset('utf8mb4');
?>
