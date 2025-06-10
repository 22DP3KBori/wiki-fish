<?php
session_start();
require_once '../include/db.php';

$is_logged_in = isset($_SESSION['user_id']);

if (!isset($_GET['subtopic_id'])) {
    die("Subtopic ID is missing.");
}

$subtopic_id = intval($_GET['subtopic_id']);
$mysqli->query("UPDATE subtopics SET views = views + 1 WHERE id = $subtopic_id");

$stmt = $mysqli->prepare("SELECT title FROM subtopics WHERE id = ?");
$stmt->bind_param("i", $subtopic_id);
$stmt->execute();
$stmt->bind_result($subtopic_title);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT m.id AS id, m.content, m.created_at, m.user_id, u.name, u.avatar AS avatar FROM messages m JOIN users u ON m.user_id = u.id WHERE m.subtopic_id = ? ORDER BY m.created_at ASC");
$stmt->bind_param("i", $subtopic_id);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makšķernieka Forums</title>
    <link rel="stylesheet" href="/css/style3.css">
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="/css/messages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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
                <a href="#" class="search-button" onclick="toggleSearch(event)"><i class="fas fa-search"></i> Meklēt</a>
            </div>
        </div>

    <div class="container">
        <h2>Komentāri apakštēmas: "<?php echo htmlspecialchars($subtopic_title); ?>"</h2>
        <div class="autoclass-3">
    <h3 class="autoclass-4"><i class="fas fa-envelope"></i> Rakstīt komentāru</h3>
    
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message" style="color:red; font-weight:bold;">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    
    <form method="POST" action="../include/create_message.php">
        <input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>">
        <textarea name="content" required placeholder="Ievadiet ziņojumu..." class="autoclass-5"></textarea><br><br>
        <button type="submit" class="autoclass-6">
            <i class="fas fa-paper-plane"></i> Nosūtīt
        </button>
    </form>
</div>

        <hr>
        
<?php while ($row = $result->fetch_assoc()):
    $is_author = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id'];
?>
<div class="comment-block">
    <div class="avatar-section">
    <?php if (!empty($row['avatar'])): ?>
        <img src="/<?= htmlspecialchars($row['avatar']) ?>" alt="avatar" class="avatar-img">
    <?php else: ?>
        <img src="/uploads/avatars/default_avatar.png" alt="avatar" class="avatar-img">
    <?php endif; ?>
    <strong class="autoclass-7"><?php echo htmlspecialchars($row['name']); ?></strong>
</div>
    <div class="content-section">
        <div class="comment-content">
                <?php
                    $is_editing = isset($_GET['edit']) && $_GET['edit'] == $row['id'];
                    if ($is_author && !$is_editing):
                ?>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                <form method="GET" style="display:inline;">
                    <input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>">
                    <input type="hidden" name="edit" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="autoclass-6">Rediģēt</button>
                </form>
                <form method="POST" action="../include/delete_message.php" onsubmit="return confirm('Vai tiešām dzēst komentāru?');" style="display:inline;">
                    <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>">
                    <button type="submit" class="autoclass-6">Dzēst</button>
                </form>
            <?php elseif ($is_author && isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
                <form method="POST" action="../include/edit_message.php">
                    <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>">
                    <textarea name="content" class="autoclass-5" required><?php echo htmlspecialchars($row['content']); ?></textarea><br>
                    <button type="submit" class="autoclass-6">Saglabāt</button>
                </form>
            <?php else: ?>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            <?php endif; ?>
        </div>
        <small class="comment-date"><?php echo $row['created_at']; ?></small>
    </div>
</div>
<?php endwhile; ?>

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

