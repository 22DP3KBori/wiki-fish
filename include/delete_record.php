<?php
session_start();
require_once 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Access denied');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $mysqli->prepare("DELETE FROM fish_records WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: ../html/record.php");
    exit();
}
?>