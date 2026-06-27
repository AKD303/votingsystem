<?php
// Simple Admin Dashboard placeholder
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Basic protection: ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in — redirect to admin login
    redirect('admin/login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - Online College Voting System</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="container">
  <div class="card">
    <h1>Admin Dashboard</h1>
    <p class="lead">Welcome, <?php echo isset($_SESSION['admin_name']) ? e($_SESSION['admin_name']) : e($_SESSION['admin_username']); ?>.</p>

    <ul>
      <li><a href="<?php echo BASE_URL; ?>/admin/login.php">Manage Students (coming)</a></li>
      <li><a href="<?php echo BASE_URL; ?>/admin/login.php">Manage Candidates (coming)</a></li>
      <li><a href="<?php echo BASE_URL; ?>/admin/login.php">Manage Positions (coming)</a></li>
      <li><a href="<?php echo BASE_URL; ?>/admin/login.php">View Results (coming)</a></li>
    </ul>

    <p style="margin-top:18px;"><a class="btn" href="<?php echo BASE_URL; ?>/logout.php">Logout</a></p>
  </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
