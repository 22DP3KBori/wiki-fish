<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Nepieciešama autorizācija.");
}

if (isset($_POST['message_id'])) {
    $message_id = intval($_POST['message_id']);
    $subtopic_id = intval($_POST['subtopic_id']);

    $stmt = $mysqli->prepare("DELETE FROM messages WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $message_id, $_SESSION['user_id']);
    $stmt->execute();
    header("Location: ../html/messages.php?subtopic_id=" . $subtopic_id);
    exit;
}
?>
