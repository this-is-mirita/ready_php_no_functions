<?php
require_once(__DIR__ . "/error.php");
try {
    // регистрация пользователя на сайте
    // очистка поля и применение на него фильтра а потом вытягение информации
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    if (strlen($login) < 3) {
        echo "Error";
        exit();
    }
    if (strlen($username) < 3) {
        echo "Error";
        exit();
    }
    // если нет @ то будет ошибка
    if (strlen($email) < 3 && str_contains($email, '@')) {
        echo "Error";
        exit();
    }
    if (strlen($password) < 3) {
        echo "Error";
        exit();
    }
    // хеширование пароля
    $hash = 'mirita_love_anime_tyan';
    $password = md5($hash . $password);

    // подключение в базе данных
    require "../Model/dbConnection.php";

    //INSERT вместо ? передаем [$login, $username, $email, $password]
    $sql = "INSERT INTO users (login, username, email, password) VALUES (?, ?, ?, ?)";
    /** @var $pdo */
    // Подготавливаем запрос
    $query = $pdo->prepare($sql);
    // выполнение команды
    $query->execute([$login, $username, $email, $password]);

    //переброс на главную
    header("Location: ../");
} catch (PDOException $exception) {
    echo $exception->getMessage();
}




























