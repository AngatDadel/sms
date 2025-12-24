<?php
require_once '../includes/functions.php';
require_login();
$search = $_GET['search'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 8;
$offset = ($page - 1) * $perPage;

$params = [];
$sqlCount = "SELECT COUNT(*) as cnt FROM students";
$sql = "SELECT * FROM students";
if ($search) {
    $sqlCount .= " WHERE name LIKE ? OR roll LIKE ?";
    $sql .= " WHERE name LIKE ? OR roll LIKE ?";
    $term = "%{$search}%";
}
$sql .= " ORDER BY id DESC LIMIT ?, ?";
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Students - SMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/navbar.php'; ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between">
    <h4>Students</h4>
    <div>
      <a href="add.php" class="btn btn-success btn-sm">Add Student</a>
      <a href="../export.php" class="btn btn-outline-secondary btn-sm">Export CSV</a>
    </div>
  </div>
  <form class="row g-2 my-2">
    <div class="col-auto">
      <input name="search" value="<?= esc($search) ?>" class="form-control" placeholder="Search name or roll">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary">Search</button>
    </div>
  </form>

  <table class="table table-striped">
    <thead><tr><th>Roll</th><th>Name</th><th>Class</th><th>Photo</th><th>Actions</th></tr></thead>
    <tbody>
    <?php
    // Count total
    if ($search) {
        $stmt = $mysqli->prepare($sqlCount);
        $stmt->bind_param('ss', $term, $term);
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc()['cnt'];
        $stmt->close();

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssii', $term, $term, $offset, $perPage);
    } else {
        $stmt = $mysqli->prepare($sqlCount);
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc()['cnt'];
        $stmt->close();

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $offset, $perPage);
    }
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()):
    ?>
      <tr>
        <td><?= esc($row['roll']) ?></td>
        <td><?= esc($row['name']) ?></td>
        <td><?= esc($row['class']) ?></td>
        <td><?php if($row['photo']): ?><img src="/sameer_siddique/uploads/<?= esc($row['photo']) ?>" style="height:40px"><?php endif; ?></td>
        <td>
          <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">View</a>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>

  <?php
  $pages = ceil($total / $perPage);
  if ($pages > 1):
  ?>
  <nav>
    <ul class="pagination">
      <?php for($i=1;$i<=$pages;$i++): ?>
        <li class="page-item <?= $i==$page? 'active':'' ?>"><a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a></li>
      <?php endfor; ?>
    </ul>
  </nav>
  <?php endif; ?>

</div>
</body>
</html>
