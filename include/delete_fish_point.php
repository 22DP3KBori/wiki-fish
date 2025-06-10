
<?php
session_start();
$role = $_SESSION['role'] ?? null;
if ($role !== 'admin') { die('Piekļuve liegta'); }
require_once 'db.php';

if (isset($_POST['point_id'])) {
    $id = intval($_POST['point_id']);
    $stmt = $mysqli->prepare("DELETE FROM fishing_locations WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: ../html/fish_map.php');
?>
