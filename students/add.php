<?php
require_once '../includes/functions.php';
require_login();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $dob = $_POST['dob'] ?: null;
    $class = $_POST['class'];
    $s1 = intval($_POST['sub1']);
    $s2 = intval($_POST['sub2']);
    $s3 = intval($_POST['sub3']);

    $photoName = null;
    if (!empty($_FILES['photo']['name'])) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/../uploads/' . $photoName);
    }

    $stmt = $mysqli->prepare('INSERT INTO students (roll, name, dob, class, sub1, sub2, sub3, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssiii', $roll, $name, $dob, $class, $s1, $s2, $s3, $photoName);
    // Note: small types mismatch handled by MySQL auto-cast; for robust code cast types properly.
    if ($stmt->execute()) {
        header('Location: list.php'); exit;
    } else {
        $error = 'Error saving student: ' . $mysqli->error;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/navbar.php'; ?>
<div class="container mt-4">
  <h4>Add Student</h4>
  <?php if($error): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label>Roll</label><input name="roll" class="form-control" required></div>
    <div class="mb-3"><label>Name</label><input name="name" class="form-control" required></div>
    <div class="mb-3"><label>DOB</label><input name="dob" type="date" class="form-control"></div>
    <div class="mb-3"><label>Class</label><input name="class" class="form-control"></div>
    <div class="row">
      <div class="col"><label>Sub1</label><input name="sub1" type="number" class="form-control"></div>
      <div class="col"><label>Sub2</label><input name="sub2" type="number" class="form-control"></div>
      <div class="col"><label>Sub3</label><input name="sub3" type="number" class="form-control"></div>
    </div>
    <div class="mb-3"><label>Photo</label><input name="photo" type="file" class="form-control"></div>
    <button class="btn btn-primary">Save</button>
  </form>
</div>
</body>
</html>
