<?php
session_start();
require_once '../include/db.php';

$is_logged_in = isset($_SESSION['user_id']);

$search = $_GET['search'] ?? '';
$results = [];

if (!empty($search)) {
    $search_like = "%" . $mysqli->real_escape_string($search) . "%";

    //searching in subtopics
    $stmt = $mysqli->prepare("SELECT id, title FROM subtopics WHERE title LIKE ?");
    $stmt->bind_param("s", $search_like);
    $stmt->execute();
    $subtopic_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    //searching in topics
    $stmt = $mysqli->prepare("SELECT id, title FROM topics WHERE title LIKE ?");
    $stmt->bind_param("s", $search_like);
    $stmt->execute();
    $topic_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    //searching messages 
    $stmt = $mysqli->prepare("SELECT m.content, m.created_at, m.subtopic_id, u.name 
        FROM messages m JOIN users u ON m.user_id = u.id 
        WHERE m.content LIKE ?");
    $stmt->bind_param("s", $search_like);
    $stmt->execute();
    $message_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Meklēšana - Makšķernieku Forums</title>
    <link rel="stylesheet" href="/css/style3.css">
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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

    <div class="container">
        <h1>Meklēšanas rezultāti</h1>
        <form method="get" action="search.php">
            <input type="text" name="search" placeholder="Meklēt..." value="<?= htmlspecialchars($search) ?>" required>
            <button type="submit"><i class="fas fa-search"></i> Meklēt</button>
        </form>

        <?php if (!empty($search)): ?>
            <h2>Rezultāti priekš: <em><?= htmlspecialchars($search) ?></em></h2>

            <?php if (!empty($topic_results)): ?>
                <h3>Tēmas</h3>
                <ul>
                    <?php foreach ($topic_results as $topic): ?>
                        <li><a href="subtopics.php?id=<?= $topic['id'] ?>"><?= htmlspecialchars($topic['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($subtopic_results)): ?>
                <h3>Apakštēmas</h3>
                <ul>
                    <?php foreach ($subtopic_results as $subtopic): ?>
                        <li><a href="messages.php?subtopic_id=<?= $subtopic['id'] ?>"><?= htmlspecialchars($subtopic['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($message_results)): ?>
                <h3>Ziņojumi</h3>
                <?php foreach ($message_results as $msg): ?>
                    <div class="message-block" style="margin-bottom: 15px; padding: 10px; border-left: 3px solid #00bcd4;">
                        <p><strong>Ziņa:</strong>
                            <a href="messages.php?subtopic_id=<?= $msg['subtopic_id'] ?>">
                                <?= htmlspecialchars(mb_strimwidth($msg['content'], 0, 80, "...")) ?>
                            </a>
                        </p>
                        <p><em>Autors: <?= htmlspecialchars($msg['name']) ?> | Datums: <?= $msg['created_at'] ?></em></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (empty($subtopic_results) && empty($topic_results) && empty($message_results)): ?>
                <p>Nekas netika atrasts.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <footer class="sticky-footer">
        <div class="social-icons">
            <a href="https://twitter.com" class="twitter"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://facebook.com" class="facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" class="instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://youtube.com" class="youtube"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </footer>
</body>
</html>
