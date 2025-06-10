<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Nav atļaujas.");
}

if (isset($_POST['topic_id'])) {
    $topic_id = intval($_POST['topic_id']);
    $stmt = $mysqli->prepare("UPDATE topics SET is_favorite = 1 WHERE id = ?");
    $stmt->bind_param("i", $topic_id);
    $stmt->execute();
    header("Location: ../html/topic.php");
    exit;
}
?>
