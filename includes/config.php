<?php
// Database configuration - update with your credentials
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'student_db';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die("DB Connection failed: " . $mysqli->connect_error);
}
session_start();
?>
