<?php
// ошибка
require_once("error.php");
try {
    // Проверяем, была ли форма отправлена
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получаем значение из поля ввода и фильтруем его
        $searchInput = trim(filter_var($_POST["searchInput"], FILTER_SANITIZE_SPECIAL_CHARS));
        // Подключаемся к базе данных
        require_once("../Model/dbConnection.php");

        // SQL-запрос для поиска по описанию
        $sql = "SELECT `id`, `image`, `followers`, `description`, `name_tyan` 
            FROM `posts` 
            WHERE `description` LIKE ?
                OR `name_tyan` LIKE ?";

        /** @var $pdo */
        // Подготавливаем запрос
        $stmt = $pdo->prepare($sql);
        // Выполняем запрос, передавая поисковый ввод в запрос
        $stmt->execute(["%$searchInput%","%$searchInput%"]);
        // Получаем результаты
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        function getPosts($arr) {
            return $arr;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<?php require_once(__DIR__ . "/../View/header.php") ?>

<div class="container">
    <div class="row mt-4"><h3>serch</h3>
        <?php if (isset($posts)) : ?>
            <?php foreach (getPosts($posts) as $post) : ?>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem; border: none">
                        <img src="../<?= $post['image'] ?>" class="card-img-top img-fluid" alt="..." style="height: 278px">
                        <div class="card-body h-100">
                            <p class="card-text">
                                <b><?= $post['description'] ?> <br></b> <br>
                                <?= "<b>Имя: </b>" . $post['name_tyan'] ?> <br>
                                <b><?= $post['followers'] ?> Followers</b>
                            </p>
                        </div>
                        <div>
                            <a class="text-dark" href="/../first-sait/View/singleTrendTyan.php?tyan_id=<?=$post['id']?>">inf</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h1>Err</h1>
        <?php endif; ?>
    </div>
</div>

<?php require_once(__DIR__ . "/../View/footer.php") ?>

