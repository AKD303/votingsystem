<?php
// Database configuration - adjust for your local XAMPP setup
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP default is empty
define('DB_NAME', 'votingsystem');

// BASE_URL: computed dynamically so the project works when placed in a folder.
// Example results:
//  - If project is at http://localhost/votingsystem/index.php -> BASE_URL = /votingsystem
//  - If project is at web root -> BASE_URL = /
if (!defined('BASE_URL')) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    if ($base === '') {
        $base = '/';
    }
    define('BASE_URL', $base);
}
?>
