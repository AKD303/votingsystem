<?php
// Simple Student Dashboard placeholder
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Basic protection: ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    // Not logged in — redirect to student login
    redirect('student/login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Dashboard - Online College Voting System</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="container">
  <div class="card">
    <h1>Student Dashboard</h1>
    <p class="lead">Welcome, <?php echo isset($_SESSION['student_name']) ? e($_SESSION['student_name']) : e($_SESSION['student_number']); ?>.</p>

    <ul>
      <li><a href="<?php echo BASE_URL; ?>/student/login.php">View Profile (coming)</a></li>
      <li><a href="<?php echo BASE_URL; ?>/student/login.php">View Candidates (coming)</a></li>
      <li><a href="<?php echo BASE_URL; ?>/student/login.php">Vote (coming)</a></li>
    </ul>

    <p style="margin-top:18px;"><a class="btn" href="<?php echo BASE_URL; ?>/logout.php">Logout</a></p>
  </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
