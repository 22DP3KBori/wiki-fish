<?php
session_start();
require_once 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Access denied');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fish_type = $_POST['fish_type'] ?? '';
    $weight = floatval($_POST['weight'] ?? 0);
    $length = floatval($_POST['length'] ?? 0);
    $location = $_POST['location'] ?? '';
    $date_catching = $_POST['date_catching'] ?? null;

    $stmt = $mysqli->prepare("INSERT INTO fish_records (fish_type, weight, length, location, date_catching) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddss", $fish_type, $weight, $length, $location, $date_catching);
    $stmt->execute();

    header("Location: ../html/record.php");
    exit();
}
?>
