<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
include('../include/db.php'); 

$topic_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// get data for subtopic for choosen topic
$stmt = $mysqli->prepare("SELECT s.id, s.title, s.created_at, u.name AS author, u.avatar AS avatar, s.views, 
       (SELECT COUNT(*) FROM messages m WHERE m.subtopic_id = s.id) AS message_count
, (SELECT COUNT(*) FROM messages m WHERE m.subtopic_id = s.id) AS message_count FROM subtopics s JOIN users u ON s.user_id = u.id WHERE s.topic_id = ? ORDER BY s.created_at ASC");
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$result = $stmt->get_result();
$subtopics = $result->fetch_all(MYSQLI_ASSOC);

// get data for topic
$stmt = $mysqli->prepare("SELECT title FROM topics WHERE id = ?");
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$topic_result = $stmt->get_result();
$topic = $topic_result->fetch_assoc();

// get message for suptopic
$stmt = $mysqli->prepare("SELECT m.content, m.created_at, u.name, u.avatar FROM messages m JOIN users u ON m.user_id = u.id WHERE m.subtopic_id = ? ORDER BY m.created_at ASC");
$stmt->bind_param("i", $topic_id); 
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style7.css">
    <link rel="stylesheet" href="/css/subtopics.css">
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
        <?php if ($topic): ?>
            <h1 class="section-title">Apakštēmas: <?= htmlspecialchars($topic['title']) ?></h1>
            
            <?php if (count($subtopics) > 0): ?>
                <div class="content">
                    <?php foreach ($subtopics as $subtopic): ?>
                        <div class="subtopic-box">
                            <div class="subtopic-left">
                                <div class="tema-icon">
                                    <?php if (!empty($subtopic['avatar'])): ?>
                                        <img src="/<?= htmlspecialchars($subtopic['avatar']) ?>" alt="avatar" class="avatar-img">
                                    <?php else: ?>
                                        <img src="/uploads/avatars/default_avatar.png" alt="avatar" class="avatar-img">
                                    <?php endif; ?>
                                </div>
                                <div class="subtopic-info">
                                    <div class="subtopic-title">
                                        <a href="messages.php?subtopic_id=<?= $subtopic['id'] ?>"><?= htmlspecialchars($subtopic['title']) ?></a>
                                    </div>
                                    <div class="subtopic-meta">
                                        Autors: <?= htmlspecialchars($subtopic['author']) ?> | Izveidoja: <?= $subtopic['created_at'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="subtopic-stats">
                                Komentāri: <?= (int)$subtopic['message_count'] ?> | Skatījumi: <?= (int)$subtopic['views'] ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="autoclass-3">Apakštēmas šai tēmai vēl nav pievienotas.</p>
            <?php endif; ?>
            
            <div class="autoclass-4">
                <a href="create_subtopic.php?id=<?= $topic_id ?>" class="autoclass-5">
                    <i class="fas fa-plus"></i> Izveidojiet jaunu apakštēmu
                </a>
            </div>
        <?php else: ?>
            <p>Tēma nav atrasta.</p>
        <?php endif; ?>

        <a href="topic.php" class="back-button" class="autoclass-6" style="color: white;">Atgriezties uz tēmu sarakstu</a>
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

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <div class="admin-panel">
        <h3>Administrēšanas panelis</h3>
        <form action="../include/delete_subtopic.php" method="post">
            <select name="subtopic_id">
                <?php foreach ($subtopics as $subtopic): ?>
                    <option value="<?php echo $subtopic['id']; ?>"><?php echo htmlspecialchars($subtopic['title']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" onclick="return confirm('Vai tiešām vēlaties dzēst šo apakštēmu?');">Dzēst apakštēmu</button>
        </form>
    </div>
<?php endif; ?>
