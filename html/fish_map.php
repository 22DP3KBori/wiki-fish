<?php
session_start();
include('../include/db.php');

$role = $_SESSION['role'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;
$is_logged_in = isset($user_id);
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makšķerēšanas vietas</title>
    <link rel="stylesheet" href="/css/style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="/css/map.css">
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

<div class="topic">
    <h1>Makšķerēšanas Karte</h1>
</div>

<div id="map"></div>

<?php if ($role === 'admin'): ?>
<div class="admin-panel">
    <h3>Administrēšanas panelis — punktu pārvaldība</h3>
    <form action="../include/add_fish_point.php" method="post">
        <label>Punkta nosaukums:</label>
        <input type="text" name="point_name" class="autoclass-1" required>
        <label>Apraksts:</label>
        <input type="text" name="description" class="autoclass-2">
        <label>Koordinātas (lat,lng):</label>
        <input type="text" name="coordinates" placeholder="56.95,24.11" class="autoclass-3" required>
        <button type="submit" class="autoclass-4">Pievienot punktu</button>
    </form>

    <form action="../include/delete_fish_point.php" method="post">
        <label class="autoclass-5">Dzēst punktu:</label>
        <select name="point_id" class="autoclass-6">
            <?php
            $points = $mysqli->query("SELECT id, title FROM fishing_locations");
            while ($p = $points->fetch_assoc()):
            ?>
            <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['title']); ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit" onclick="return confirm('Dzēst эту точку?');">Dzēst punktu</button>
    </form>
</div>
<?php endif; ?>


<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 56.9496, lng: 24.1052 },
        zoom: 7
    });

    <?php
    $result = $mysqli->query("SELECT id, title, description, ST_X(coordinates) AS lng, ST_Y(coordinates) AS lat FROM fishing_locations");
    while ($row = $result->fetch_assoc()):
        $title = htmlspecialchars($row['title']);
        $desc = htmlspecialchars($row['description']);
    ?>
    (function() {
        const marker = new google.maps.Marker({
            position: { lat: <?php echo $row['lat']; ?>, lng: <?php echo $row['lng']; ?> },
            map: map,
            title: "<?php echo $title; ?>"
        });
        const infowindow = new google.maps.InfoWindow({
            content: `<div class="autoclass-7"><b>Punkta nosaukums:</b> <?php echo $title; ?><br><b>Apraksts:</b> <?php echo $desc; ?></div>`
        });
        marker.addListener('click', () => {
            infowindow.open(map, marker);
        });
    })();
    <?php endwhile; ?>
}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDknPY6ttHWymt7OMAEjD4v_Scpq8UkTGk&callback=initMap"></script>

<footer class="sticky-footer">
    <div class="social-icons">
        <a href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
        <a href="https://facebook.com"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://instagram.com"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://youtube.com"><i class="fa-brands fa-youtube"></i></a>
    </div>
</footer>

</body>
</html>
