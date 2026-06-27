<?php
// Login selection page - Module 2
require_once __DIR__ . '/includes/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Online College Voting System</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<main class="container">
  <div class="card">
    <h1>Login</h1>
    <p class="lead">Choose your role to proceed to the appropriate login page.</p>

    <div class="login-options">
      <div class="login-option">
        <h3>Admin</h3>
        <p>Administrators manage students, positions, candidates and view results.</p>
        <a class="btn" href="admin/login.php">Admin Login</a>
      </div>

      <div class="login-option">
        <h3>Student</h3>
        <p>Students can view candidates and vote once per position.</p>
        <a class="btn" href="student/login.php">Student Login</a>
      </div>
    </div>

    <p class="footer-note">Note: Authentication will be implemented in Module 3 using secure password hashing and prepared statements.</p>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
<script src="assets/js/main.js"></script>
</body>
</html>
