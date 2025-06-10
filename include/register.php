<?php
session_start();
require_once '../include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["user"]);
    $password = $_POST["pass"];
    $password2 = $_POST["pass2"];
    $email = trim($_POST["email"]);
    $nameSurname = trim($_POST["name_surname"]);

    if (strlen($password) < 6) {
    header("Location: ../register.php?error=short_password");
    exit();
}

if ($password !== $password2) {
        header("Location: ../html/register.php?error=pass_mismatch");
        exit();
    }

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: ../html/register.php?error=nickname_exists");
        exit();
    }
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE mail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: ../html/register.php?error=email_exists");
        exit();
    }
    $stmt->close();

    $role = 'user';

    $stmt = $mysqli->prepare("INSERT INTO users (name, password, mail, name_surname, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $nameSurname, $role);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $username;
        $_SESSION['role'] = $role;
        header('Location: ../html/main.php');
        exit();
    } else {
        header("Location: ../html/register.php?error=unknown");
        exit();
    }
}
?>
