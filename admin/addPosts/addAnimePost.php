<?php
require_once (__DIR__ . "/../../controllers/error.php");

// Начинаем буферизацию вывода
ob_start();

try {
    // Проверка, что запрос является POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы и их фильтрация
        $image = trim(filter_var($_POST['image'], FILTER_SANITIZE_SPECIAL_CHARS));
        $followers = trim(filter_var($_POST['followers'], FILTER_SANITIZE_NUMBER_INT));
        $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
        $name_tyan = trim(filter_var($_POST['name_tyan'], FILTER_SANITIZE_SPECIAL_CHARS));

        // Проверка валидности данных
        if (strlen($image) < 3) {
            throw new Exception("Ошибка: Неверное значение для 'Image'.");
        }
        if (strlen($followers) < 1) {
            throw new Exception("Ошибка: Неверное значение для 'Followers'.");
        }

        // Подключение к базе данных
        require_once(__DIR__ . "../../Model/dbConnection.php");

        // Проверка подключения
        if (!isset($pdo)) {
            throw new Exception("Ошибка: Не удалось подключиться к базе данных.");
        }

        // Подготовка SQL-запроса
        $sql = "INSERT INTO posts (image, followers, description, name_tyan) VALUES (:image, :followers, :description, :name_tyan)";
        $query = $pdo->prepare($sql);

        // Проверка подготовки запроса
        if ($query === false) {
            $errorInfo = $pdo->errorInfo();
            throw new Exception("Ошибка подготовки запроса: " . implode(", ", $errorInfo));
        }

        // Выполнение запроса
        $result = $query->execute([
            ':image' => $image,
            ':followers' => $followers,
            ':description' => $description,
            ':name_tyan' => $name_tyan
        ]);

        // Проверка выполнения запроса
        if ($result) {

            // Редирект на страницу списка постов
            header("Location: /first-sait/admin/admin-start-page.php");
            exit();
        } else {
            $errorInfo = $query->errorInfo();
            throw new Exception("Ошибка при выполнении запроса: " . implode(", ", $errorInfo));
        }
    } else {
        throw new Exception("Ошибка: запрос не является POST.");
    }
} catch (Exception $e) {
    // Выводим сообщение об ошибке
    echo "Произошла ошибка: " . $e->getMessage() . "<br>";
    exit();
}

