<?php
session_start();  


if (isset($_POST['user']) && isset($_POST['pass'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    
    $query = "SELECT id, username, role FROM users WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();  
        $_SESSION['user_id'] = $user['id'];  
        $_SESSION['username'] = $user['username'];  
        $_SESSION['role'] = $user['role'];  
        
        echo "User ID: " . $_SESSION['user_id'] . "<br>";
        echo "Username: " . $_SESSION['username'] . "<br>";
        echo "Role: " . $_SESSION['role'] . "<br>";

        header('Location: main.php');  
        exit();  
    } else {
        echo "Nepareizi pieteikšanās dati!";  
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login by Kirills Borisovs</title>
    <link rel="stylesheet" href="/css/login+register(1).css">
    <link rel="stylesheet" href="/css/login+register(2).css">
</head>
<body>
    <dev class="container">
        
<?php if (isset($_GET['error'])): ?>
    <div class="notification error show">
    <div class="error">
        <?php
            switch ($_GET['error']) {
                case 'user_not_found':
                    echo 'Lietotājs nav atrasts!';
                    break;
                case 'wrong_password':
                    echo 'Nepareiza parole!';
                    break;
            }
        ?>
    </div>
    </div>
<?php endif; ?>

<form action="/include/login.php" method="POST">
            <div class="login_container">

                <div class="login_title">
                    <span>Login</span>
                </div>

                <div class="input_wrapper">
                    <input type="text" id="user" name="user" class="input_field" required>
                    <label for="user" class="label">Lietotājvārds</label>
                    <i class="fa-regular fa-user icon "></i>
                </div>

                <div class="input_wrapper">
                    <input type="password" id="pass" name="pass" class="input_field" required>
                    <label for="pass" class="label">Parole</label>
                    <i class="fa-solid fa-lock icon "></i>
                </div>
                    
                <div class="forgot_pass">
                    <p><a href="forgot_password.php">Aizmirsāt savu paroli?</a></p>
                </div>

                <div class="input_wrapper">
                    <input type="submit" class="input-submit" value="Login">
                </div>

                <div class="signup">
                    <span> Jums nav konta <a href="register.php">| Reģistrēties</a> </span>
                </div>
            </div>
        </form>
    </dev>
</body>

