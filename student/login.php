<?php
// Student login placeholder - Module 2
// Actual authentication will be added in Module 3.
require_once __DIR__ . '/../includes/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Login - Online College Voting System</title>
  <link rel="stylesheet" href="/AKD303/votingsystem/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="container">
  <div class="card">
    <h2>Student Login (placeholder)</h2>
    <p class="lead">This form is a placeholder. Module 3 will implement secure login.</p>

    <form method="post" action="#">
      <div class="input-group">
        <label for="student_number">Student Number or Email</label>
        <input id="student_number" name="student_number" type="text" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
      </div>
      <button class="btn" type="submit">Login</button>
    </form>

    <p class="footer-note">Back to <a href="/AKD303/votingsystem/login.php">role selection</a></p>
  </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
