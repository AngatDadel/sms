<?php
require_once '../includes/functions.php';
require_login();
$id = intval($_GET['id']);
$stmt = $mysqli->prepare('DELETE FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
header('Location: list.php');
exit;
?>
