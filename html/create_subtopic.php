<?php
session_start();
require_once '../include/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Lai izveidotu apakštēmu, lūdzu, autorizējieties!';
    header('Location: login.php');
    exit();
}

$is_logged_in = true;


$topic_id = ($_SERVER['REQUEST_METHOD'] === 'POST')
    ? (int)($_POST['topic_id'] ?? 0)
    : (int)($_GET['id'] ?? 0);

if ($topic_id <= 0) {
    die("Nederīgs tēmas ID.");
}


$stmt = $mysqli->prepare("SELECT COUNT(*) FROM topics WHERE id = ?");
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count === 0) {
    die("Tēma ar ID $topic_id nav atrasta.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);

    if (empty($title)) {
        $error = "Apakštēmas nosaukuma lauks nedrīkst būt tukšs.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO subtopics (title, topic_id, user_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sii", $title, $topic_id, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
        header("Location: subtopics.php?id=$topic_id");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Izveidot apakštēmu</title>
    <link rel="stylesheet" href="/css/style8.css">
    <link rel="stylesheet" href="https:
    <link rel="stylesheet" href="/css/custom_style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <div class="logo">Makšķernieka Forums</div>
        <a href="main.php"><i class="fas fa-home"></i> Sākums</a>
        <a href="topic.php"><i class="fas fa-comments"></i> Temas</a>
        <a href="fish_map.php"><i class="fas fa-fish"></i> Makšķerēšanas vietas</a>
        <a href="record.php"><i class="fas fa-trophy"></i> Rekordu tabula</a>
    </div>
    <div class="nav-right">
        <?php if (!$is_logged_in): ?>
            <a href="login.php"><i class="fas fa-user"></i> Pieteikties</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Reģistrēties</a>
        <?php else: ?>
            <a href="profile_settings.php"><i class="fas fa-user-circle"></i> Mans profils</a>
            <a href="../include/logout.php"><i class="fas fa-sign-out-alt"></i> Iziet</a>
        <?php endif; ?>
    </div>
</div>

<div class="content">
    <h2>Izveidojiet apakštēmu</h2>
    <?php if (isset($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="create_subtopic.php" method="POST">
        <input type="hidden" name="topic_id" value="<?= htmlspecialchars($topic_id) ?>">
        <label for="title">Apakštēmas nosaukums</label>
        <input type="text" id="title" name="title" class="wide-input" required>
        <button type="submit">Izveidojiet apakštēmu</button>
    </form>
</div>

<footer class="sticky-footer">
    <div class="social-icons">
        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
    </div>
</footer>

</body>
</html>
