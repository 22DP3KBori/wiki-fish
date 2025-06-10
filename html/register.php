<?php
session_start();
require_once '../include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["user"]);
    $password = $_POST["pass"];
    $password2 = $_POST["pass2"];
    $email = trim($_POST["email"]);

    if ($password !== $password2) {
        die("Пароли не совпадают!");
    }

    $plain_password = $password;
    $role = 'user';

    $stmt = $mysqli->prepare("INSERT INTO users (name, password, mail, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $plain_password, $email, $role);

    if ($stmt->execute()) {
        $new_user_id = $stmt->insert_id;

        
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['user_name'] = $username;
        $_SESSION['role'] = $role;

        session_write_close();
        header('Location: ../html/main.php');
        exit();
    } else {
        echo "Ошибка регистрации!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register by Kirills Borisovs</title>
    <link rel="stylesheet" href="/css/style2.css">
    <link rel="stylesheet" href="https:
    <link rel="stylesheet" href="/css/custom_style.css">
</head>
<body>
    <div class="container">
        <form id="registerForm" class="card" action="../include/register.php" method="post" enctype="multipart/form-data">
            <div class="register_container"> 
                <div class="register_title"> 
                    <span>Register</span>
                </div>

                <div class="input_wrapper">
                    <input type="text" id="user" name="user" class="input_field" required>
                    <label for="user" class="label">Lietotājvārds</label>
                    <i class="fa-regular fa-user icon"></i>
                    <div id="userError" class="error-message"></div>
                </div>

                <div class="input_wrapper">
                    <input type="password" id="pass" name="pass" class="input_field" required>
                    <label for="pass" class="label">Parole</label>
                    <i class="fa-solid fa-lock icon"></i>
                    <div id="passError" class="error-message"></div>
                </div>

                <div class="input_wrapper">
                    <input type="password" id="pass2" name="pass2" class="input_field" required>
                    <label for="pass2" class="label">Otro reizi parole</label>
                    <i class="fa-solid fa-lock icon"></i>
                    <div id="pass2Error" class="error-message"></div>
                </div>

                <div class="input_wrapper">
                    <input type="email" id="email" name="email" class="input_field" required>
                    <label for="email" class="label">Jūsu pasts</label>
                    <i class="fa-solid fa-envelope icon"></i>
                    <div id="emailError" class="error-message"></div>
                </div>

                <div class="input_wrapper">
                    <input type="text" id="name_surname" name="name_surname" class="input_field" required>
                    <label for="name_surname" class="label">Vārds Uzvārds</label>
                    <i class="fa-solid fa-user icon"></i>
                    <div id="nameSurnameError" class="error-message"></div>
                </div>

                <div class="input_wrapper">
                    <input type="submit" class="input-submit" value="Register">
                </div>

                <div class="signup">
                    <span>Jums jau ir konts <a href="login.php">| Piesakieties</a></span>
                </div>
            </div>
        </form>
    </div>

    <div id="notification" class="notification">
        Nepareizi dati. Lūdzu, pārbaudiet veidlapu.
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registerForm");
            const userInput = document.getElementById("user");
            const emailInput = document.getElementById("email");
            const passInput = document.getElementById("pass");
            const pass2Input = document.getElementById("pass2");
            const notification = document.getElementById("notification");
            const userError = document.getElementById("userError");
            const passError = document.getElementById("passError");
            const pass2Error = document.getElementById("pass2Error");
            const emailError = document.getElementById("emailError");

            form.addEventListener("submit", function (event) {
                let hasError = false;
                let errorMessage = '';

                
                notification.classList.remove("show");
                userError.textContent = "";
                emailError.textContent = "";
                passError.textContent = "";
                pass2Error.textContent = "";

                const username = userInput.value.trim();
                const email = emailInput.value.trim();
                const password = passInput.value.trim();
                const password2 = pass2Input.value.trim();

                const usernameRegex = /^[a-zA-Z0-9_-]{3,20}$/;
                if (!usernameRegex.test(username)) {
                    errorMessage = "Nepareizs username. Lūdzu, izlabojiet to.";
                    hasError = true;
                }

                if (password.length < 6) {
                    errorMessage = "Parolei jābūt vismaz 6 rakstzīmēm garai.";
                    hasError = true;
                }

                
                if (password !== password2) {
                    errorMessage = "Paroles nesakrīt.";
                    hasError = true;
                }

                
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errorMessage = "Nepareizs e-pasts. Lūdzu, izlabojiet to.";
                    hasError = true;
                }

                
                if (hasError) {
                    event.preventDefault();
                    notification.textContent = errorMessage;
                    notification.classList.add("show");
                }
            });
        });
    </script>

<div id="errorBox" class="notification error" style="display: none;"></div>
<script>
function showError(message) {
    const box = document.getElementById('errorBox');
    box.innerText = message;
    box.style.display = 'block';
    setTimeout(() => {
        box.style.display = 'none';
    }, 4000);
}
</script>

<?php if (isset($_GET['error'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php
            switch ($_GET['error']) {
                case 'nickname_exists':
                    echo "showError('Lietotājvārds jau ir aizņemts!');";
                    break;
                case 'email_exists':
                    echo "showError('E-pasts jau ir reģistrēts!');";
                    break;
                case 'short_password':
                    echo "showError('Parole ir pārāk īsa!');";
                    break;
                case 'invalid_email':
                    echo "showError('Nepareizs e-pasta formāts!');";
                    break;
                case 'pass_mismatch':
                    echo "showError('Paroles nesakrīt!');";
                    break;
                case 'unknown':
                    echo "showError('Nezināma kļūda!');";
                    break;
            }
        ?>
    });
</script>
<?php endif; ?>


</body>
</html>
