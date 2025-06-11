<?php
session_start();
require_once '../include/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profila iestatījumi</title>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <script src="js/profile_settings.js"></script>
    <div class="navbar">
        <div class="nav-left">
            <div class="logo">Makšķernieka Forums</div>
            <a href="main.php"><i class="fas fa-home"></i> Sākums</a>
            <a href="topic.php"><i class="fas fa-comments"></i> Temas</a>
            <a href="fish_map.php"><i class="fas fa-fish"></i> Makšķerēšanas vietas</a>
            <a href="record.php"><i class="fas fa-trophy"></i> Rekordu tabula</a>
        </div>
        <div class="nav-right">
            <a href="profile_settings.php"><i class="fas fa-user-circle"></i> Mans profils</a>
            <a href="../include/logout.php"><i class="fas fa-sign-out-alt"></i> Iziet</a>
        </div>
    </div>

    <div class="container">
        <h1><strong>Profila iestatījumi</strong></h1>
        <?php if (isset($_GET['success'])): ?>
        <div class="autoclass-1">Profils veiksmīgi atjaunināts!</div>
        <?php endif; ?>
        <div class="autoclass-2">
            <strong>Pašreizējais avatars:</strong><br>
            <img src="/<?php echo htmlspecialchars($user['avatar'] ?? 'uploads/avatars/6960e9dc98143868.jpg'); ?>" width="100" height="100" class="autoclass-3">
        </div>
        <form action="../include/update_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Lietotājvārds:</label><br>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
            </div>
            <div class="form-group">
                <label for="email">E-pasts:</label><br>
                <input type="email" id="email" name="mail" value="<?php echo htmlspecialchars($user['mail']); ?>" required><br>
            </div>
            <div class="form-group">
                <label for="avatar">Jauns avatars:</label><br>
                <label class="custom-file-upload">
                    Izvēlēties failu
                    <input type="file" id="avatar" name="avatar">
                </label>
                <span id="file-name" class="file-name">Nav izvēlēts fails</span><br>
            </div>
            <div class="form-group">
                <label for="name_surname">Vārds un Uzvārds</label>
                <input type="text" id="name_surname" name="name_surname" value="<?php echo htmlspecialchars($user['name_surname'] ?? ''); ?>"><br>
            </div>
            <div class="form-group">
                <button type="submit" class="profile-submit-btn">Saglabāt izmaiņas</button>
            </div>
        </form>
    </div>

    <div id="searchBox" class="search-container">
        <label for="search">Meklēt:</label>
        <input type="text" id="search" placeholder="Atslēgvārds..."><br><br>
        <div id="searchBox-checkbox" class="searchBoxas">
            <input type="checkbox" name="c[title_only]" value="1">
            <label for="title-search">Tikai virsrakstos</label><br><br>
        </div>
        <label for="author">Autors:</label>
        <input type="text" id="author" placeholder="Autors...">
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