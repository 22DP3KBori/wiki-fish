<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";
 
// Создание подключения
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}

// Пример запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $pdo->prepare("SELECT * FROM таблица WHERE поле = ?");
    $query->execute([$_POST['значение']]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
}
?>
