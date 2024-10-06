<?php

session_start();
//data | Выносим данные из POST в другие переменные

$name = $_POST['user'];
$pass = $_POST['pass'];
$pass_confirmation = $_POST['pass2'];
$email = $_POST['email'];

//validate

$_SESSION['validation'] = [];

if(empty($user)){
    $_SESSION['validation' ['user']] = 'Неверное имя';
}

if(!empty($_SESSION['validation'])){
    //redirect on registration page
    header('Location: /register.html');
}
//add user ->bd


$pdo = getPDO();

$query = "INSERT INTO users (user_name, user_pass, user_mail) VALUES (:user_name, :user_pass, :user_mail)";

$params = [
    'user_name' => $name,
    'user_pass' => $pass,
    'user_mail' => password_hash($pass, PASSWORD_DEFAULT)
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}
