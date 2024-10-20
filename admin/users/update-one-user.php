<?php

// Подключение к базе данных
require_once(__DIR__ . "/../../Model/dbConnection.php");
require_once(__DIR__ . "/../../controllers/error.php");

// Получение данных из формы и фильтрация
$user_id = trim(filter_var($_POST["user_id"], FILTER_SANITIZE_SPECIAL_CHARS));
$login = trim(filter_var($_POST["login"], FILTER_SANITIZE_SPECIAL_CHARS));
$username = trim(filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS));
$is_admin = trim(filter_var($_POST["is_admin"], FILTER_SANITIZE_SPECIAL_CHARS));
$linkimg = trim(filter_var($_POST["linkimg"], FILTER_SANITIZE_SPECIAL_CHARS));

// SQL-запрос для обновления данных пользователя
$sql = "UPDATE users 
        SET login = ?, username = ?, email = ?, password = ?, is_admin = ?, linkimg = ? 
        WHERE id = ?";

// Подготовка и выполнение запроса
$query = $pdo->prepare($sql);
$update_success = $query->execute([$login, $username, $email, $password, $is_admin, $linkimg, $user_id]);

// Проверка результата выполнения
if ($update_success) {
    header('Location: admin-users.php'); // Перенаправление на страницу пользователей
    exit;
} else {
    echo "Ошибка при обновлении данных."; // Вывод ошибки
    print_r($query->errorInfo()); // Дополнительная информация об ошибке
    exit;
}
