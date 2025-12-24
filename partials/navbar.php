<?php
// Properly start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../dashboard.php">SMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="students/list.php">Students</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['user_name'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <?= htmlspecialchars($_SESSION['user_name'] ?? 'User', ENT_QUOTES, 'UTF-8') ?>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../auth/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="../auth/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>