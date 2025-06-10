<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../html/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['username']) ? strip_tags($_POST['username']) : '';
    $mail = isset($_POST['mail']) ? strip_tags($_POST['mail']) : '';
    $nameSurname = isset($_POST['name_surname']) ? strip_tags($_POST['name_surname']) : '';
    $avatarPath = '';
    $password = $_POST['password'] ?? '';

    if (!empty($_FILES['avatar']['tmp_name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowed)) {
            $newName = bin2hex(random_bytes(8)) . ".$ext";
            $destPath = __DIR__ . "/../uploads/avatars/" . $newName;
            list($w, $h) = getimagesize($_FILES['avatar']['tmp_name']);
            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $src = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
                    break;
                case 'png':
                    $src = imagecreatefrompng($_FILES['avatar']['tmp_name']);
                    break;
                case 'gif':
                    $src = imagecreatefromgif($_FILES['avatar']['tmp_name']);
                    break;
            }
            $dst = imagecreatetruecolor(150, 150);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, 150, 150, $w, $h);
            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($dst, $destPath);
                    break;
                case 'png':
                    imagepng($dst, $destPath);
                    break;
                case 'gif':
                    imagegif($dst, $destPath);
                    break;
            }
            imagedestroy($src);
            imagedestroy($dst);
            $avatarPath = 'uploads/avatars/' . $newName;
        }
    }

    $sql = "UPDATE users SET name = ?, mail = ?, name_surname = ?";
    $params = [$name, $mail, $nameSurname];
    $types = "sss";

    if (!empty($password)) {
        $sql .= ", password = ?";
        $params[] = password_hash($password, PASSWORD_DEFAULT);
        $types .= "s";
    }

    if (!empty($avatarPath)) {
        $sql .= ", avatar = ?";
        $params[] = $avatarPath;
        $types .= "s";
    }

    $sql .= " WHERE id = ?";
    $params[] = $user_id;
    $types .= "i";

    $stmt = $mysqli->prepare($sql);
    if ($stmt === false) {
        die("Kļūda, sagatavojot pieprasījumu: " . $mysqli->error);
    }
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    header('Location: ../html/profile_settings.php?success=1');
    exit();
}
?>
