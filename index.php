<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login by Kirills Borisovs</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <form action="">
        <div class="login_container">

            <div class="login_title">
                <span>Login</span>
            </div>

            <div class="input_wrapper">
                <input type="text" id="user" class="input_field" required>
                <label for="user" class="label">Lietotājvārds</label>
                <i class="fa-regular fa-user icon "></i>
            </div>

            <div class="input_wrapper">
                <input type="password" id="pass" class="input_field" required>
                <label for="pass" class="label">Parole</label>
                <i class="fa-solid fa-lock icon "></i>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Atcerieties mani!</label>
                </div>
                
                <div class="forgot_pass">
                    <a href="#">Aizmirsāt savu paroli</a>
                </div>
            </div>

            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Login">
            </div>

            <div class="signup">
                <span> Jums nav konta <a href="register.php">| Reģistrēties</a> </span>
            </div>
        </div>
        </form>
    </div>

</body>
</html>