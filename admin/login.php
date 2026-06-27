<?php
// Admin login - Module 3
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($username === '' || $password === '') {
        $errors[] = 'Please enter both username and password.';
    } else {
        $stmt = $mysqli->prepare("SELECT id, username, password, full_name FROM admins WHERE username = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $db_username, $db_password_hash, $full_name);
                $stmt->fetch();
                if (password_verify($password, $db_password_hash)) {
                    // Successful login
                    session_regenerate_id(true);
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['admin_username'] = $db_username;
                    $_SESSION['admin_name'] = $full_name;
                    redirect('admin/index.php');
                } else {
                    $errors[] = 'Invalid username or password.';
                }
            } else {
                $errors[] = 'Invalid username or password.';
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
  <title>Admin Login - Online College Voting System</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="container">
  <div class="card">
    <h2>Admin Login</h2>
    <p class="lead">Administrators manage students, positions, candidates and view results.</p>

    <?php if (!empty($errors)): ?>
      <div style="background:#ffe6e6;border:1px solid #ffcccc;padding:10px;border-radius:6px;margin-bottom:12px;color:#900;">
        <?php foreach ($errors as $err): ?>
          <div><?php echo e($err); ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="input-group">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required value="<?php echo isset($username) ? e($username) : ''; ?>">
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
