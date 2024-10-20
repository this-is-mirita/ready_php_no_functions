<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"><?php
//<!--ошибка-->
//<!-- датабасе -->
require_once(__DIR__ . "/../../Model/dbConnection.php");
require_once(__DIR__ . "/../../controllers/error.php");
try {
    $posts_id = $_GET['posts_id'] ?? null;
    if(!$posts_id){
        echo "posts_id не передан";
        exit();
    }
//запрос
    $sql = "SELECT * FROM posts WHERE id = ?";
//подготовка
    /* @var $pdo */
    $query = $pdo->prepare($sql);
// выполнение
    $query->execute([$posts_id]);
//получение
    $one_row = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<?php require_once(__DIR__ . "/../../View/header.php") ?>
<div class="container d-flex justify-content-center align-items-center" style="height: 50vh">
    <?php if ($one_row) : ?>
        <?php foreach ($one_row as $one) : ?>
            <form method="post" action="update-one-post.php" class="w-100">
                <div class="row gy-3 justify-content-center">
                    <!-- скрытое поле с id -->
                    <div class="col-md-2">
                        <input type="hidden" value="<?= $one['id']; ?>" name="posts_id">
                    </div>
                    <!-- колонка для Image -->
                    <div class="col-md-2">
                        <label for="new_image" class="form-label">Image</label>
                        <input type="text" class="form-control" id="new_image" value="<?= $one['image']; ?>" name="new_image">
                    </div>
                    <!-- колонка для Followers -->
                    <div class="col-md-2">
                        <label for="new_followers" class="form-label">Followers</label>
                        <input type="text" class="form-control" id="new_followers" value="<?= $one['followers']; ?>" name="new_followers">
                    </div>
                    <!-- новая колонка для description -->
                    <div class="col-md-2">
                        <label for="new_rating" class="form-label">description</label>
                        <input type="text" class="form-control" id="new_description" name="new_description" value="<?= $one['description']; ?>">
                    </div>
                    <!-- новая колонка для Name -->
                    <div class="col-md-2">
                        <label for="new_comments" class="form-label">Name</label>
                        <input type="text" class="form-control" id="new_name_tyan" name="new_name_tyan" value="<?= $one['name_tyan']; ?>">
                    </div>
                    <!-- кнопка обновления -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100">Обновить данные</button>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php require_once(__DIR__ . "/../../View/footer.php") ?>


