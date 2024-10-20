<?php
// Включаем отображение ошибок для отладки и подключаем бд
require_once(__DIR__ . "/../../Model/dbConnection.php");
require_once(__DIR__ . "/../../controllers/error.php");
try {
    // Проверяем, была ли отправлена форма с posts_id
    if (isset($_POST['posts_id'])) {
        $posts_id = $_POST['posts_id'];
        // Фильтруем и проверяем входные данные
        $new_image = trim(filter_var($_POST["new_image"], FILTER_SANITIZE_SPECIAL_CHARS));
        $new_followers = trim(filter_var($_POST["new_followers"], FILTER_SANITIZE_NUMBER_INT));
        $new_description = trim(filter_var($_POST["new_description"], FILTER_SANITIZE_SPECIAL_CHARS));
        $new_name_tyan = trim(filter_var($_POST["new_name_tyan"], FILTER_SANITIZE_SPECIAL_CHARS));

        // Подготовка SQL-запроса
        $sql = "UPDATE posts SET image = ?, followers = ?, description = ?, name_tyan = ? WHERE id = ?";
        /** @var $pdo */
        $query = $pdo->prepare($sql);

        // Выполнение запроса и проверка успешности
        if ($query->execute([$new_image, $new_followers, $new_description, $new_name_tyan, $posts_id])) {
            // Прямой редирект на страницу со списком постов
            header("Location: /first-sait/admin/admin-start-page.php?page=admin-posts");
            exit;
        } else {
            // В случае ошибки выводим информацию об ошибке
            echo "Ошибка при обновлении данных.";
            print_r($query->errorInfo());
            exit;
        }
    } else {
        // Если posts_id не передан, выводим сообщение об ошибке
        echo "posts_id не передан.";
        exit();
    }
}catch (Exception $e){
    echo $e->getMessage();
}