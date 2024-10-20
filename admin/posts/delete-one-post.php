<?php
//<!--ошибка-->
require_once(__DIR__ . "/../../controllers/error.php");
//<!-- датабасе -->
require_once(__DIR__ . "/../../Model/dbConnection.php");
try {
    $post_id = $_GET['post_id'];
    echo $post_id;

//запрос
    $sql = "DELETE FROM posts WHERE id = ?";
//подготовка
    /* @var $pdo */
    $query = $pdo->prepare($sql);
//отправка
    $query->execute([$post_id]);

//можно использовать глобальную переменную $_SERVER['HTTP_REFERER'], которая содержит URL предыдущей страницы, откуда был сделан запрос.
// Проверяем, существует ли информация о предыдущей странице
    if (isset($_SERVER['HTTP_REFERER'])) {
        // Возвращаемся на предыдущую страницу
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit; // Завершаем скрипт после редиректа
    } else {
        // Если предыдущая страница неизвестна, перенаправляем на другую страницу (например, главную)
        header("Location: /first-sait/admin/admin-start-page.php");
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

