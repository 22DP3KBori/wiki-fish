<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userEmail = $_POST['email'];  
    $userPassword = $_POST['password'];  

    
    $reset_code = rand(100000, 999999);  

    
    $mail = new PHPMailer(true);
    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $userEmail;  
        $mail->Password = $userPassword;  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';

        
        $mail->setFrom($userEmail, 'Makšķernieka Forums');  

        
        $mail->addAddress($userEmail);  

        
        $mail->Subject = 'Paroles atkopšanas kods';

        
        $mail->Body = "Jūsu paroles atkopšanas kods: $reset_code";

        
        $mail->send();

        $_SESSION['reset_code'] = $reset_code;
        $_SESSION['email'] = $userEmail;
        header("Location: verify_code.php");
        exit();

    } catch (Exception $e) {
        echo "Kļūda, sūtot e-pastu: {$mail->ErrorInfo}";
    }
}
?>

<html>
<body>
    <h2>Ievadiet savu e-pasta adresi un paroli, lai atgūtu paroli</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="e-mail" />
        <input type="password" name="password" required placeholder="Ievadiet savu e-pasta paroli" />
        <button type="submit">Sūtīt kodu</button>
    </form>
</body>
</html>
