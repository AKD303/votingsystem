<?php
// Student login - Module 3
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = isset($_POST['student_number']) ? trim($_POST['student_number']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($identifier === '' || $password === '') {
        $errors[] = 'Please enter your student number (or email) and password.';
    } else {
        // Allow login by student_number or email
        $stmt = $mysqli->prepare("SELECT id, student_number, first_name, last_name, password FROM students WHERE student_number = ? OR email = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('ss', $identifier, $identifier);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $student_number, $first_name, $last_name, $db_password_hash);
                $stmt->fetch();
                if (password_verify($password, $db_password_hash)) {
                    // Successful login
                    session_regenerate_id(true);
                    $_SESSION['student_id'] = $id;
                    $_SESSION['student_number'] = $student_number;
                    $_SESSION['student_name'] = $first_name . ' ' . $last_name;
                    redirect('student/index.php');
                } else {
                    $errors[] = 'Invalid student number/email or password.';
                }
            } else {
                $errors[] = 'Invalid student number/email or password.';
            }
            $stmt->close();
        } else {
            $errors[] = 'Database error: failed to prepare statement.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Login - Online College Voting System</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="container">
  <div class="card">
    <h2>Student Login</h2>
    <p class="lead">Students can view candidates and vote once per position.</p>

    <?php if (!empty($errors)): ?>
      <div style="background:#ffe6e6;border:1px solid #ffcccc;padding:10px;border-radius:6px;margin-bottom:12px;color:#900;">
        <?php foreach ($errors as $err): ?>
          <div><?php echo e($err); ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="input-group">
        <label for="student_number">Student Number or Email</label>
        <input id="student_number" name="student_number" type="text" required value="<?php echo isset($identifier) ? e($identifier) : ''; ?>">
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
      </div>
      <button class="btn" type="submit">Login</button>
    </form>

    <p class="footer-note">Back to <a href="<?php echo BASE_URL; ?>/login.php">role selection</a></p>
  </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
