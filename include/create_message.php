<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Nepieciešama autorizācija.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (mb_strlen($content) > 5000) {
        $_SESSION['error'] = "Komentārs – pārāk garš teksts (max 5000 simboli)";
        header("Location: ../html/messages.php?subtopic_id=" . $subtopic_id);
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $subtopic_id = intval($_POST['subtopic_id']);
    $content = trim($_POST['content']);

    if ($content === '') {
        die("Ziņojuma lauks nedrīkst būt tukšs.");
    }

    $stmt = $mysqli->prepare("INSERT INTO messages (subtopic_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $subtopic_id, $user_id, $content);

    if ($stmt->execute()) {
        header("Location: ../html/messages.php?subtopic_id=" . $subtopic_id);
        exit;
    } else {
        echo "Pievienojot ziņojumu, radās kļūda.";
    }
}
?>
