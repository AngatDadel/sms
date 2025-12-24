<?php
require_once '../includes/functions.php';
require_login();
$id = intval($_GET['id']);
$stmt = $mysqli->prepare('SELECT * FROM students WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$s = $stmt->get_result()->fetch_assoc();
if (!$s) { echo 'Not found'; exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>View Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<?php include '../partials/navbar.php'; ?>
<div class="container mt-4">
  <h4><?= esc($s['name']) ?></h4>
  <p><strong>Roll:</strong> <?= esc($s['roll']) ?></p>
  <p><strong>Class:</strong> <?= esc($s['class']) ?></p>
  <p><strong>DOB:</strong> <?= esc($s['dob']) ?></p>
  <?php if($s['photo']): ?><img src="/sameer_siddique/uploads/<?= esc($s['photo']) ?>" style="max-width:200px"><?php endif; ?>
  <p><a href="list.php" class="btn btn-secondary mt-3">Back</a></p>
</div>
</body></html>
