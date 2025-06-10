<?php
session_start(); 

require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["user"]);
    $password = $_POST["pass"];

    
    $stmt = $mysqli->prepare("SELECT id, password, role FROM users WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $stored_password, $role);
        $stmt->fetch();

        if ($password === $stored_password) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $username;
            $_SESSION["role"] = $role; 

            header("Location: /html/main.php");
            exit;
        } else {
            header("Location: ../html/login.php?error=wrong_password");
    exit();
        }
    } else {
        header("Location: ../html/login.php?error=user_not_found");
    exit();
    }
}
?>