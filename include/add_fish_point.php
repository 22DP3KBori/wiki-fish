
<?php
session_start();
$role = $_SESSION['role'] ?? null;
if ($role !== 'admin') { die('Доступ запрещён'); }
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['point_name']);
    $desc = trim($_POST['description']);
    $coords_input = trim($_POST['coordinates']); 
    list($lat, $lng) = explode(',', $coords_input);
    $point_wkt = "POINT($lng $lat)";

    $stmt = $mysqli->prepare("INSERT INTO fishing_locations (title, description, coordinates) VALUES (?, ?, ST_GeomFromText(?))");
    $stmt->bind_param('sss', $title, $desc, $point_wkt);
    $stmt->execute();
}
header('Location: ../html/fish_map.php');
?>
