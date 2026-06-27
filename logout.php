<?php
// Logout script — destroys session and redirects to login selection
session_start();
// Unset all session variables
$_SESSION = [];
// Destroy session cookie if exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Redirect to main login selection
require_once __DIR__ . '/includes/config.php';
header('Location: ' . rtrim(BASE_URL, '/') . '/login.php');
exit;
?>
