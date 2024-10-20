<?php
require_once("error.php"); // файл для вывода ошибок

// Подключение к базе данных
require "../Model/dbConnection.php";

try {
    // Фильтрация входных данных
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
    $password = trim($_POST['password']); // Пароль лучше не изменять для безопасности

    // Хеширование пароля
    $hash = 'mirita_love_anime_tyan';
    $hashedPassword = md5($hash . $password); // Старое хэширование

    // Запрос к базе данных для проверки существования пользователя
    $sql = "SELECT id FROM users WHERE login = ? AND password = ? LIMIT 1";

    // Подготовка запроса
    /** @var $pdo */
    $query = $pdo->prepare($sql);

    // Выполнение запроса с переданными значениями
    $query->execute([$login, $hashedPassword]);

    // Проверка, найден ли пользователь
    if ($query->rowCount() === 0) {
        // Редирект на страницу ошибки
        header("Location: ../View/error.php?message=invalid_user");
        exit(); // Завершаем выполнение скрипта
    } else {
        // Успешная авторизация, установка cookie
        setcookie("user", $login, time() + 3600 * 24 * 30, "/");
        header("Location: ../"); // Редирект на главную страницу
        exit(); // Завершаем выполнение скрипта
    }

} catch (PDOException $e) {
    // Если произошла ошибка, выводим сообщение
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
