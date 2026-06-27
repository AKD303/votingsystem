<?php
// Seed script to create an initial admin account.
// Run once from CLI: php database/seed_admin.php
// or open in browser (not recommended on public servers).

require_once __DIR__ . '/../includes/db_connect.php';

// Initial credentials (change after first login)
$username = 'admin';
$password_plain = 'admin123';
$full_name = 'System Administrator';

// Hash the password using PHP's password_hash()
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Check if admin already exists
$stmt = $mysqli->prepare("SELECT id FROM admins WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "Admin user '{$username}' already exists. Aborting.\n";
    $stmt->close();
    exit;
}
$stmt->close();

// Insert admin
$insert = $mysqli->prepare("INSERT INTO admins (username, password, full_name) VALUES (?, ?, ?) ");
$insert->bind_param('sss', $username, $password_hash, $full_name);
if ($insert->execute()) {
    echo "Admin created successfully.\nUsername: {$username}\nPassword: {$password_plain}\n";
} else {
    echo "Error creating admin: " . $insert->error . "\n";
}
$insert->close();
$mysqli->close();
?>
