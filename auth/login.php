<?php
session_start();

// If already logged in, go to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ../dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Hardcoded credentials (change these if you want)
    $valid_email = 'admin@example.com';
    $valid_password = 'admin123';  // Plain text password (we'll compare directly)
    $valid_name = 'Admin';
    $valid_role = 'admin';

    if ($email === $valid_email && $password === $valid_password) {
        // Login success
        $_SESSION['user_id'] = 1;               // fake ID
        $_SESSION['user_name'] = $valid_name;
        $_SESSION['user_role'] = $valid_role;

        header('Location: ../dashboard.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 380px;
            width: 100%;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            background: white;
        }
        .login-title {
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
        }
        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            background-color: #0d6efd;
            border: none;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
        }
        .default-cred {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h4 class="login-title">Login</h4>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="admin@example.com" required autofocus>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" value="admin123" required>
        </div>

        <button type="submit" class="btn btn-primary btn-login w-100">Login</button>
    </form>

    <div class="default-cred">
        Default: admin@example.com / admin123
    </div>
</div>

</body>
</html>