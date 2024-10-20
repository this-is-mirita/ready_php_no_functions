<!-- шапка -->
<?php require_once(__DIR__ . "/../../View/header.php") ?>
<!--ошибка-->
<?php require_once(__DIR__ . "/../../controllers/error.php") ?>
<!-- датабасе -->
<?php require_once(__DIR__ . "/../../Model/dbConnection.php"); ?>

<div class="container my-5">
    <div class="row">
        <?php
            //запрос
            $sql = "SELECT `id`, `image`, `followers`, `description`, `name_tyan` FROM `posts`";
            //подготовка
            /* @var $pdo */
            $query = $pdo->prepare($sql);
            //отправка
            $query->execute();
            // полученние данных всех
            $all_rows = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="col-12">
            <a href="../admin-start-page.php" class="btn btn-dark px-5 mb-4">вернуться назад</a>
            <?php foreach ($all_rows as $row) : ?>
                <div class="row" post_id="<?= $row['id'] ?>">
                    <div class="col-1">
                        <p class="text-dark fs-5">айди</p>
                        <p class=""><?= $row['id'] ?></p>
                    </div>
                    <div class="col-1">
                        <p class="text-dark fs-5">ссылка</p>
                        <p><?= $row['image'] ?></p>
                    </div>
                    <div class="col-2">
                        <p class="text-dark fs-5">Список подписчиков</p>
                        <p><?= $row['followers'] ?></p>
                    </div>
                    <div class="col-4">
                        <p class="text-dark fs-5">Описание</p>
                        <p><?= $row['description'] ?></p>
                    </div>
                    <div class="col-1">
                        <p class="text-dark fs-5">Имя</p>
                        <p><?= $row['name_tyan'] ?></p>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-dark">
                            <a class="text-white" href="delete-one-post.php?post_id=<?= $row['id'] ?>">delete</a>
                        </button>
                        <button class="btn btn-dark">
                            <a class="text-white" href="updateLinkedTemplate.php?posts_id=<?= $row['id'] ?>">update</a>
                        </button>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
