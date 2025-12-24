<?php
// Start session and include config (which probably starts session and connects DB)
require_once 'includes/config.php';  // Better to include config.php instead of functions.php

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}

// Optional: Include functions if you really need them
// require_once 'includes/functions.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard - Student Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/navbar.php'; ?>

<div class="container mt-4">
  <h3>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User', ENT_QUOTES, 'UTF-8') ?></h3>
  <p>Use the navigation to manage students.</p>
  
  <div class="row">
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Students</h5>
        <p><a href="students/list.php" class="btn btn-sm btn-outline-primary">Manage Students</a></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>