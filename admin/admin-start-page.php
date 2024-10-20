<?php require_once(__DIR__ . "/../controllers/error.php")?>
<!-- шапка -->
<?php require_once(__DIR__ . "/../View/header.php") ?>
<?php

?>
<div class="container my-5 d-flex justify-content-center">
    <div class="row w-50">
        <div class="col-12">
            <div class="list-group text-center">
                <a href="posts/admin-posts.php" class="list-group-item list-group-item-action">
                    Список постов
                </a>
                <a href="addPosts/user.php" class="list-group-item list-group-item-action">
                    Добавление фото
                </a>
                <a href="users/admin-users.php" class="list-group-item list-group-item-action">
                    Список пользователей
                </a>
            </div>
        </div>
    </div>
</div>

