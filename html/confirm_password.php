<?php
session_start();
require_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'] ?? null;

    if (!$email) {
        die("Nav derīga sesija.");
    }

    if ($new_password !== $confirm_password) {
        $error = "Paroles nesakrīt!";
    } else {
        $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE mail = ?");
        $stmt->bind_param("ss", $new_password, $email);
        $stmt->execute();
        $stmt->close();

        unset($_SESSION['email']);
        unset($_SESSION['reset_code']);

        header("Location: login.php?reset=success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Paroles maiņa</title>
</head>
<body>
    <h2>Ievadiet jauno paroli</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label for="new_password">Jaunā parole:</label>
        <input type="password" name="new_password" required><br>
        <label for="confirm_password">Apstipriniet paroli:</label>
        <input type="password" name="confirm_password" required><br>
        <button type="submit">Mainīt paroli</button>
    </form>
</body>
</html>
