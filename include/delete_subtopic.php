<?php
session_start();
require_once '../include/db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Piekļuve liegta');
}

if (isset($_POST['subtopic_id'])) {
    $subtopic_id = intval($_POST['subtopic_id']);
    $stmt = $mysqli->prepare("DELETE FROM subtopics WHERE id = ?");
    $stmt->bind_param("i", $subtopic_id);
    $stmt->execute();
}

header('Location: ../html/subtopics.php');
exit();
?>
