<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_code = $_POST['reset_code'] ?? '';

    if (!isset($_SESSION['reset_code']) || $entered_code != $_SESSION['reset_code']) {
        $error = "Nepareizs kods!";
    } else {
        header("Location: confirm_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Pārbaudes kods</title>
</head>
<body>
    <h2>Ievadi kodu, kas tika nosūtīts uz e-pastu</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label for="reset_code">Kods:</label>
        <input type="text" name="reset_code" required>
        <button type="submit">Apstiprināt</button>
    </form>
</body>
</html>
