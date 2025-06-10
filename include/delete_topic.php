<?php
session_start();
require_once '../include/db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Piekļuve liegta');
}

if (isset($_POST['topic_id'])) {
    $topic_id = intval($_POST['topic_id']);
    $stmt = $mysqli->prepare("DELETE FROM topics WHERE id = ?");
    $stmt->bind_param("i", $topic_id);
    $stmt->execute();
}

header('Location: ../html/topic.php');
exit();
?>
