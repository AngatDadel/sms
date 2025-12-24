<?php
require_once 'includes/functions.php';
require_login();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="students_export.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, ['ID','Roll','Name','DOB','Class','Sub1','Sub2','Sub3','Created At']);

$res = $mysqli->query('SELECT * FROM students ORDER BY id DESC');
while ($row = $res->fetch_assoc()) {
    fputcsv($out, [$row['id'],$row['roll'],$row['name'],$row['dob'],$row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['created_at']]);
}
fclose($out);
exit;
?>
