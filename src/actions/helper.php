<?php

session_start();

require_once __DIR__ . '/config.php';

function redirect(string $path)
{
    header("Location: $path");
    die();
}

function setValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}

function hasValidationError(string $fieldName): bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAttr(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName): string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

function setOldValue(string $key, mixed $value): void
{
    $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function uploadFile(array $file, string $prefix = ''): string
{
    $uploadPath = __DIR__ . '/../uploads';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";

    if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
        die('Ошибка при загрузке файла на сервер');
    }

    return "uploads/$fileName";
}


function getPDO(): PDO{
    try {
        return new PDO('mysql:host=' . DB_HOST . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);}
    catch (\PDOException $e) {
        die($e->getMessage());
    }
    }

