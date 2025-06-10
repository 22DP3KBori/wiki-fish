<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Nepieciešama autorizācija.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = intval($_POST['message_id']);
    $new_content = trim($_POST['content']);

    if ($new_content === '') {
        die("Ziņojuma lauks nedrīkst būt tukšs.");
    }

    $stmt = $mysqli->prepare("UPDATE messages SET content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $new_content, $message_id, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: ../html/messages.php?subtopic_id=" . intval($_POST['subtopic_id']));
        exit;
    } else {
        echo "Atjauninot ziņojumu, radās kļūda.";
    }
}
?>
