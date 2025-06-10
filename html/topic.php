<?php
    session_start();
    $role = $_SESSION['role'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;
    $is_logged_in = isset($user_id);

    if ($is_logged_in) {
    if (isset($_SESSION['role'])) {
        
    } else {
        echo "Loma nav atrasta!";
    }
} else {
    echo "Lietotājs nav autorizēts!";
}

    include '../include/db.php'; 

    $stmt = $mysqli->prepare("SELECT t.id, t.title, t.created_at, t.is_favorite, u.name AS author, u.avatar 
                            FROM topics t 
                            JOIN users u ON t.user_id = u.id 
                            ORDER BY t.is_favorite DESC, t.created_at ASC");


    $stmt->execute();
    $result = $stmt->get_result();
    $topics = $result->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT id, title, created_at FROM topics ORDER BY is_favorite DESC, created_at DESC";
    $result = $mysqli->query($query);

    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temas - Makšķernieku Forums</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style4.css">
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="/css/topic.css">
</head>
    <script>
        function toggleSearch(event) {
        var searchBox = document.getElementById("searchBox");
        searchBox.style.display = searchBox.style.display === "block" ? "none" : "block";
        event.stopPropagation();
        }
        document.addEventListener("click", function(event) {
            var searchBox = document.getElementById("searchBox");
            if (searchBox.style.display === "block" && !searchBox.contains(event.target) && event.target.className !== "search-button") {
                searchBox.style.display = "none";
            }
        });
    </script>
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="/css/topic.css">
</head>
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
            <a href="#" class="search-button" onclick="toggleSearch(event)"><i class="fas fa-search"></i> Meklēt</a>
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
    <div class="create-topic">
        <a href="create_topic.php" class="new-topic-btn">
            <i class="fas fa-plus"></i> Izveidot tēmu
        </a>
    </div>
    <?php endif; ?>

    <div class="container">
    <h1 class="section-title">Foruma tēmas</h1>
    <div class="topics-list">

    <?php foreach ($topics as $topic): ?>
        <div class="tema-box">
            <div class="tema-left">
                <div class="tema-icon">
                    <?php if (!empty($topic['avatar'])): ?>
                        <img src="/<?= htmlspecialchars($topic['avatar']) ?>" alt="avatar" class="avatar-img">
                    <?php else: ?>
                        <i class="fas fa-user-circle"></i>
                    <?php endif; ?>
                </div>
                <?php if ($topic['title'] === 'Ziņot par kļūdu'): ?>
    <i class="fas fa-screwdriver-wrench"></i>
<?php else: ?>
    <i class="fas fa-comments"></i>
<?php endif; ?>

                <div class="tema-info">
                    <a href="subtopics.php?id=<?= $topic['id'] ?>" class="tema-title">
                        <?= htmlspecialchars($topic['title']) ?>
                        <?php if ($topic['is_favorite'] == 1): ?>
                            <span title="Izlases tēma" style="color: gold;">★</span>
                        <?php endif; ?>
                    </a>
                    <div class="tema-meta">
                        Autors: <?= htmlspecialchars($topic['author']) ?> |
                        <?= $topic['created_at'] ?>
                    </div>
                    <?php if ($role === 'admin' && $topic['is_favorite'] == 0): ?>
                        <form method="POST" action="../include/favorite_topic.php" style="margin-top: 5px;">
                            <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>">
                            <button type="submit" class="autoclass-6">★ Pievienot izlasei</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>





</div>


    <form method="get" action="search.php" id="searchBox" class="search-container">
        <label for="search">Meklēt:</label>
        <input type="text" id="search" name="search" placeholder="Atslēgvārds..."><br><br>
        <div id="searchBox-checkbox" class="searchBoxas">
            <input type="checkbox" name="title_only" value="1" id="title-search">
            <label for="title-search">Tikai virsrakstos</label><br><br>
        </div>
        <label for="author">Autors:</label>
        <input type="text" id="author" name="author" placeholder="Autors...">
        <br><br>
        <button type="submit">Meklēt</button>
    </form>

     <?php if ($role === 'admin'): ?>
    <div class="admin-panel">
        <h3>Administrēšanas panelis — tēmu dzēšana</h3>
        <form action="../include/delete_topic.php" method="post">
            <select name="topic_id">
                <?php foreach ($topics as $topic): ?>
                    <option value="<?php echo $topic['id']; ?>"><?php echo htmlspecialchars($topic['title']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту тему?');">Dzēst tēmu</button>
        </form>
    </div>
    <?php endif; ?>

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

