<?php
session_start();
include '../include/db.php'; 

$is_logged_in = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']); 

    if (empty($title)) {
        $error = "Tēmas nosaukuma lauks nedrīkst būt tukšs.";
    } else {
        
        $stmt = $mysqli->prepare("INSERT INTO topics (title, user_id, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $title, $_SESSION['user_id']); 
        $stmt->execute();
        $stmt->close();
        header("Location: topic.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Izveidojiet tēmu</title>
    <link rel="stylesheet" href="/css/style8.css">
    <link rel="stylesheet" href="/css/custom_style.css">
</head>
<body>

<div class="content">
    <h2>Izveidojiet tēmu</h2>
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <form action="create_topic.php" method="POST">
        <label for="title">Tēmas nosaukums</label>
        <input type="text" id="title" name="title" required>
        <button type="submit">Izveidojiet tēmu</button>
    </form>
</div>

</body>
</html>
