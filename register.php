<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login by Kirills Borisovs</title>
    <link rel="stylesheet" href="/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <form class="card" action="src/actions/register.php" method="post" enctype="multipart/form-data">
        <div class="register_container"> 

            <div class="register_title"> 
                <span>Register</span>
            </div>

            <div class="input_wrapper">
                <input type="text" id="user" name="user" class="input_field" required>
                <label for="user" class="label">Lietotājvārds</label>
                <i class="fa-regular fa-user icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="password" id="pass" name="pass" class="input_field" required>
                <label for="pass" class="label">Parole</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="password" id="pass2" name="pass2" class="input_field" required>
                <label for="pass2" class="label">Otro reizi parole</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="email" id="email" name="email" class="input_field" required>
                <label for="pass2" class="label">Jūsu pasts</label>
                <i class="fa-solid fa-envelope icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Register">
            </div>

            <div class="signup">
                <span> Jums jau ir konts <a href="index.php">| Piesakieties</a> </span>
            </div>
        </div>
        </form>
    </div>

</body>
</html>