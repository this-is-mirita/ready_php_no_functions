<?php

session_start(); // Старт сессии
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : '';
$form_was_submitted = isset($_SESSION["form_submitted"]) ? $_SESSION["form_submitted"] : false;

require_once(__DIR__ . "/controllers/error.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>потерял надежду</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<!--шапка-->
<?php require_once( __DIR__ . "/View/header.php") ?>
<!--шапка-->
<main>
    <!--    1 блок с текстом и фото-->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 mb-4 d-flex flex-column justify-content-center">
                <h2>Никчемность и Тлен</h2>
                <h1>Наши творения для тех, кто давно потерял надежду</h1>
                <p>Мы создаем аниме, в котором каждая история пропитана мрачной пустотой. Ваши персонажи обречены на
                    вечное
                    скитание в мире, где свет надежды давно погас. Все усилия тщетны, все эмоции пусты.</p>
                <p>Наша студия пережила многие потерянные годы, и каждый проект — это лишь очередная попытка найти смысл
                    в
                    бесконечной череде провалов. Мы работаем в тени, используя холод технологий, чтобы оживить призраки
                    былого.</p>
                <p>Выберите нас, если ваши идеи родились из отчаяния, и вы хотите донести свою безысходность миру. Мы не
                    обещаем света в конце тоннеля, но можем гарантировать, что каждая история отзовется холодом в сердце
                    каждого зрителя.</p>

                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#commentModal">
                    Ничего не узнать
                </button>
                <!-- Модальное окно -->
                <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Заголовок модального окна -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentModalLabel">Добавить комментарий</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <!-- Тело модального окна с формой -->
                            <?php
                                require_once __DIR__ . "/Functions/functions.php";
                            ?>
                            <div class="modal-body">
                                <form id="commentForm" action="admin/index-get-comment/process_comment.php" method="POST">
                                    <div class="mb-3">
                                        <label for="nameInput" class="form-label">Имя</label>
                                        <input type="text" class="form-control" id="nameInput" name="name" value="<?= htmlspecialchars(getPostVal('name')); ?>" >

                                        <span style="color:red;">
                                            <?php
                                            echo htmlspecialchars($error_message);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="commentInput" class="form-label">Комментарий</label>
                                        <textarea class="form-control" id="commentInput" name="comment" rows="3" ><?= htmlspecialchars(getPostVal('comment')); ?></textarea>
                                        <span style="color:red;">
                                            <?php echo htmlspecialchars($error_message); ?>
                                        </span>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Отправить</button>
                                </form>
                                <?php
                                    // Очищаем сообщение об ошибке и флаг после отображения
                                    unset($_SESSION["error_message"]);
                                    unset($_SESSION["form_submitted"]);
                                ?>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Если форма была отправлена, открываем модальное окно
                                        <?php if ($form_was_submitted && !empty($error_message)): ?>
                                        var commentModal = new bootstrap.Modal(document.getElementById('commentModal'));
                                        commentModal.show();
                                        <?php endif; ?>
                                    });
                                </script>
                            </div>
                            <!-- Футер модального окна с кнопкой закрытия -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                #nameInput{
                    border-radius: 0; !important;
                    border-color: black; !important;
                }
                #commentInput{
                    border-radius: 0; !important;
                    border-color: black; !important;
                }
            </style>

            <div class="col-md-6">
                <img src="img/anime-start.png" alt="Anime" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
    <!--    вывод 4 аниме с бд-->
    <div class="container my-5">
        <a href="View/allPosts.php" class="btn btn-link text-dark">Все посты</a>
        <div class="row align-items-center align-center ">
            <div class="col-2">
                <h3>Trend tyan</h3>
            </div>
            <div class="col-4">
                <form method="post" action="controllers/search.php">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control" type="search" name="searchInput" id="searchInput">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-dark" type="submit">search</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <?php
                // бд
                require_once(__DIR__ . "/Model/dbConnection.php");
                // выбор из бд ток 4 записи
                $sql = "SELECT * FROM `posts` ORDER BY id DESC LIMIT 4";
                /** @var $pdo */
                // Подготавливаем запрос
                $query = $pdo->prepare($sql);
                // Проверяем, что execute не вызывается с параметрами
                $query->execute(); // Здесь всё верно, так как у вас нет параметров
                // Получение данных в переменную
                $posts = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-3">
                    <div class="card h-100" style="width: 18rem; border: none">
                        <img src="<?= $post['image'] ?>" class="card-img-top img-fluid" alt="..." style="height: 278px">
                        <div class="card-body h-100">
                            <div class="card-text h-100">
                                <div class="justify-content-center">
                                    <b><?= $post['description'] ?> <br></b> <br>
                                    <?= "<b>Имя: </b>" . $post['name_tyan'] ?> <br>
                                    <b><?= $post['followers'] ?> Followers</b>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a class="text-dark" href="View/singleTrendTyan.php?tyan_id=<?=$post['id']?>">inf</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--слайдер-->
    <div class="container mb-5">
        <h3>Next Season Anime</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imgForslider/1.png" class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <?php
                // запрос на вывод фото для слайдера первая это дефолт она актиа поэтому > 1
                $sql = "SELECT * FROM `sliders` where id > 1";
                //подготовка
                $query = $pdo->prepare($sql);
                // отправка
                $query->execute();
                // получение данных в переменную
                $sliders = $query->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($sliders);
                ?>
                <!--// сам вывод фото-->
                <?php foreach ($sliders as $item): ?>
                    <div class="carousel-item">
                        <img src="imgForslider/<?= $item['image'] ?>" class="d-block w-100 img-fluid" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-black"><?= $item['title'] ?></h5>
                            <p class="text-black"><?= $item['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--карточки усуги-->
    <div class="container mt-4">
        <?php
        $sql = "SELECT `id`, `name`, `description`, `price`, `duration` FROM `services`";
        //подготовка
        $query = $pdo->prepare($sql);
        // отправка
        $query->execute();
        // получение данных в переменную
        $services = $query->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($services);

        ?>
        <h3>Наши услуги</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <div class="row">
            <?php foreach ($services as $service) : ?>
                <div class="col-md-3">
                    <div class="card border-dark mb-3 h-100" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-dark">
                            <h5 class="card-title"><?= $service['name'] ?></h5>
                        </div>
                        <div class="card-body text-black">
                            <b><p class="card-text"><?= $service['description'] ?></p></b> <br>
                            <p class="card-text">Стоимость: <?= $service['price'] ?></p>
                            <p class="card-text"><?= $service['duration'] ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-success">Footer</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
    <div class="container mb-5 p-3">
        <div class="text-center mb-5">
            <h3 class="text-muted">Подписка на новости в мире тьмы</h3>
            <p class="text-muted">Станьте свидетелем неизменных изменений, которые вас никогда не порадуют.</p>
            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <div class="mb-4">
                    <h4 class="text-danger">Будьте в курсе безысходности</h4>
                    <p class="text-muted">Подпишитесь на наши мрачные обновления, чтобы не пропустить очередные
                        печальные новости. Мы обещаем, что вы будете первыми узнавать о новых утратам и непрекращающемся
                        разочаровании.</p>
                    <p class="text-muted">Наши рассылки содержат лишь безнадёжные мысли и события, которые напоминают о
                        том, как трудно идти вперёд.</p>
                    <p class="text-muted">Заполните поле ниже, и вы всегда будете в курсе самых грустных событий нашей
                        компании.</p>
                </div>
                <div class="w-50">
                    <input type="email" name="email" id="emailField" placeholder="Введите email" class="form-control mb-2"
                           aria-label="Email для подписки">
                    <button onclick="" class="btn btn-dark w-100">Подписаться на тьму</button>
                </div>
            </div>
        </div>

    </div>
    <hr>
</main>

<!--футер-->
<?php require_once(__DIR__ . "/View/footer.php") ?>
<!--футер-->
