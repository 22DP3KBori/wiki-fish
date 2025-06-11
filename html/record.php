<?php
session_start();
require_once '../include/db.php';

$role = $_SESSION['role'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;
$is_logged_in = isset($user_id);

// Initialize filter and sort variables
$fish_filter = isset($_GET['fish_filter']) ? $_GET['fish_filter'] : 'all';
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'date_desc';

// Prepare SQL query with filter and sort
$query = "SELECT * FROM fish_records";
if ($fish_filter !== 'all') {
    $fish_filter = $mysqli->real_escape_string($fish_filter);
    $query .= " WHERE fish_type = '$fish_filter'";
}
$sort_mapping = [
    'date_desc' => 'date_catching DESC',
    'date_asc' => 'date_catching ASC',
    'title_asc' => 'fish_type ASC',
    'title_desc' => 'fish_type DESC',
    'weight_asc' => 'weight ASC',
    'weight_desc' => 'weight DESC',
    'length_asc' => 'length ASC',
    'length_desc' => 'length DESC'
];
$query .= " ORDER BY " . $sort_mapping[$sort_option];

$result = $mysqli->query($query);
$records = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Rekordu tabula</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/css/custom_style.css">
    <link rel="stylesheet" href="/css/record.css">
</head>
<body>
    <div class="wrapper">
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

        <div class="section-label">
            <h1>Zivju rekordi</h1>
        </div>

        <form class="filter-form" method="get" action="record.php">
            <label for="fish_filter">Filtrēt zivis:</label>
            <select name="fish_filter" id="fish_filter">
                <option value="all" <?php echo $fish_filter === 'all' ? 'selected' : ''; ?>>Visas zivis</option>
                <option value="Asaris" <?php echo $fish_filter === 'Asaris' ? 'selected' : ''; ?>>Asaris</option>
                <option value="Līdaka" <?php echo $fish_filter === 'Līdaka' ? 'selected' : ''; ?>>Līdaka</option>
                <option value="Sams" <?php echo $fish_filter === 'Sams' ? 'selected' : ''; ?>>Sams</option>
                <option value="Forele" <?php echo $fish_filter === 'Forele' ? 'selected' : ''; ?>>Forele</option>
                <option value="Karpa" <?php echo $fish_filter === 'Karpa' ? 'selected' : ''; ?>>Karpa</option>
                <option value="Rauda" <?php echo $fish_filter === 'Rauda' ? 'selected' : ''; ?>>Rauda</option>
            </select>
            <label for="sort">Kārtot pēc:</label>
            <select name="sort" id="sort">
                <option value="date_desc" <?php echo $sort_option === 'date_desc' ? 'selected' : ''; ?>>Datums (jaunākais)</option>
                <option value="date_asc" <?php echo $sort_option === 'date_asc' ? 'selected' : ''; ?>>Datums (vecākais)</option>
                <option value="title_asc" <?php echo $sort_option === 'title_asc' ? 'selected' : ''; ?>>Nosaukums (A-Z)</option>
                <option value="title_desc" <?php echo $sort_option === 'title_desc' ? 'selected' : ''; ?>>Nosaukums (Z-A)</option>
                <option value="weight_asc" <?php echo $sort_option === 'weight_asc' ? 'selected' : ''; ?>>Svars (augošs)</option>
                <option value="weight_desc" <?php echo $sort_option === 'weight_desc' ? 'selected' : ''; ?>>Svars (dilstošs)</option>
                <option value="length_asc" <?php echo $sort_option === 'length_asc' ? 'selected' : ''; ?>>Garums (augošs)</option>
                <option value="length_desc" <?php echo $sort_option === 'length_desc' ? 'selected' : ''; ?>>Garums (dilstošs)</option>
            </select>
            <button type="submit">Filtrēt</button>
        </form>

        <?php if ($role === 'admin'): ?>
        <form class="admin-form" method="post" action="../include/add_record.php">
            <input type="text" name="fish_type" placeholder="Tipa zivs" required>
            <input type="number" step="0.01" name="weight" placeholder="Svars (kg)" required>
            <input type="number" step="0.01" name="length" placeholder="Garums (cm)" required>
            <input type="text" name="location" placeholder="Vieta" required>
            <input type="date" name="date_catching" required>
            <button type="submit">Pievienot rekordu</button>
        </form>
        <?php endif; ?>

        <table class="record-table">
            <thead>
                <tr>
                    <th>Zivs</th>
                    <th>Svars (kg)</th>
                    <th>Garums (cm)</th>
                    <th>Vieta</th>
                    <th>Datums</th>
                    <?php if ($role === 'admin') echo '<th>Admin</th>'; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $rec): ?>
                <tr>
                    <td><?= htmlspecialchars($rec['fish_type']) ?></td>
                    <td><?= $rec['weight'] ?></td>
                    <td><?= $rec['length'] ?></td>
                    <td><?= htmlspecialchars($rec['location']) ?></td>
                    <td><?= htmlspecialchars($rec['date_catching']) ?></td>
                    <?php if ($role === 'admin'): ?>
                    <td>
                        <form method="post" action="../include/delete_record.php" onsubmit="return confirm('Vai tiešām dzēst?');">
                            <input type="hidden" name="id" value="<?= $rec['id'] ?>">
                            <button class="delete-btn" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>