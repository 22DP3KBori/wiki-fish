<?php
$host = '127.127.126.31';
$user = 'root';
$password = '';
$db = 'makskiernieka_forums';

$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_error) {
    die('Savienojuma kļūda: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
