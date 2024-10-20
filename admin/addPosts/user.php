<?php
require_once (__DIR__ . "/../../controllers/error.php");
//<!-- шапка -->
require_once(__DIR__ . "/../../View/header.php");
?>

<div class="container my-5">
    <a href="../admin-start-page.php" class="btn btn-dark px-5 mb-4">вернуться назад</a>
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card  text-white p-4">
                <h2 class="mb-3 text-dark">Кабинет пользователя</h2>
                <h3 class="text-dark">Добавление новой фотграфии в бд через ссылку из папки</h3>
                <p class="text-dark">Привет, <b><?= $_COOKIE['user'] ?>.</b></p>

                <?php
                require_once(__DIR__ . "/../../Model/dbConnection.php");

                // количество изображений в бд
                $sql = "SELECT COUNT(id) as total_image FROM posts";
                /** @var $pdo */
                $query = $pdo->prepare($sql);
                $query->execute();
                $items = $query->fetch(PDO::FETCH_ASSOC);
                ?>

                <p class="text-dark">Всего изображений в базе данных <b
                            class="text-dark"><?= $items['total_image'] ?></b></p>
                <p class="text-dark">Добавлять строго по форме из папки img, если показывает что сейчас 6 то пишем
                    img/7.jpg </p>
                <form method="post" action="addAnimePost.php">

                    <div class="form-group">
                        <label class="text-dark mb-2" for="image">Фото</label>
                        <input type="text" class="form-control text-dark mb-2" id="image" name="image"
                               placeholder="Введите URL изображения">
                    </div>

                    <div class="form-group">
                        <label class="text-dark mb-2" for="followers">Followers</label>
                        <input type="text" class="form-control text-dark mb-2" id="followers" name="followers"
                               placeholder="Введите количество подписчиков">
                    </div>

                    <div class="form-group">
                        <label class="text-dark mb-2" for="description">description</label>
                        <input type="text" class="form-control text-dark mb-2" id="description" name="description"
                               placeholder="Введите количество подписчиков">
                    </div>

                    <div class="form-group">
                        <label class="text-dark mb-2" for="name_tyan">name_tyan</label>
                        <input type="text" class="form-control text-dark mb-2" id="name_tyan" name="name_tyan"
                               placeholder="Введите количество подписчиков">
                    </div>

                    <button type="submit" class="btn btn-dark btn-block mt-4">ADD NEW</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- футер -->
<?php require_once(__DIR__ . "/../../View/footer.php") ?>
<!-- футер -->
