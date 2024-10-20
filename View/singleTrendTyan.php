<?php
require_once(__DIR__ . "/../controllers/error.php");
require_once(__DIR__ . "/../Model/dbConnection.php");
require_once(__DIR__ . "/header.php");
try {
    // Проверка наличия параметра и его валидности
    if (isset($_GET['tyan_id']) && is_numeric($_GET['tyan_id'])) {
        $tyan_id = $_GET['tyan_id'];

        // Подготовка SQL запроса
        $sql = "SELECT `id`, `image`, `followers`, `description`, `name_tyan` FROM `posts` WHERE `id` = ?";
        /** @var $pdo */
        $stmt = $pdo->prepare($sql);

        // Выполнение запроса
        $stmt->execute([$tyan_id]);

        // Получаем пост
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверяем, есть ли данные
        if ($post) {
            echo getTyan($post);
        } else {
            echo "Пост не найден.";
        }
    } else {
        echo "Неверный идентификатор.";
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
// выводит тянку из бд передается в иф выше
function getTyan($post){
    // первый див фотка и описание фторой форма для комента
    return "
       
        <div class='container mb-5'>
            <div class='post'>
                <div class='row'>
                    <div class='col-md-6'>
                        <img class='img-fluid rounded shadow-sm' src='../" . htmlspecialchars($post['image']) . "' style='2max-height: 430px;' alt=''>
                        <button class='btn btn-dark mt-1'><a class='text-white' href='../index.php'>glavnaya</a></button>
                    </div>
                    <div class='col-md-6'>
                        <div class='description'>
                            <h2 class='mb-3'>" . htmlspecialchars($post['name_tyan']) . "</h2>
                            <p class='text-muted'>" . htmlspecialchars($post['description']) . "</p>
                            <p class='fw-bold'>Подписчиков: <span class='text-primary'>" . htmlspecialchars($post['followers']) . "</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container'>
            <div class='form-check form-switch'>
                <input class='form-check-input' type='checkbox' role='switch' id='flexSwitchCheckDefault'>
                <label class='form-check-label dark' for='flexSwitchCheckDefault'>show form comment</label>
            </div>
        </div>
        <div class='container mb-5' id='form-comment' style='display:none';>
            <div class='col-md-8'>
                <!-- Форма добавления комментария -->
                <form action='singleTrendTyan.php' method='post' class='bg-light p-4 rounded shadow-sm'>
                    <h5 class='mb-4'>+ Добавить комментарий</h5>
                    
                    <!-- Поле для скрытого идентификатора tyan -->
                    <input type='hidden' name='tyan_id' class='form-control' value='" . htmlspecialchars($post['id']) . "'>
    
                    <!-- Поле для имени пользователя -->
                    <div class='form-outline mb-3'>
                        <label class='form-label' for='name'>Ваше имя</label>
                        <input type='text' name='name' id='name' class='form-control' value='" . htmlspecialchars($_COOKIE['user'] ?? '') . "' required>
                    </div>
    
                    <!-- Поле для комментария -->
                    <div class='form-outline mb-3'>
                        <label class='form-label' for='addANote'>Комментарий</label>
                        <textarea name='comment' id='addANote' class='form-control' rows='4' placeholder='Напишите комментарий...' required></textarea>
                    </div>
    
                    <!-- Кнопка отправки -->
                    <button type='submit' class='btn btn-dark btn-lg'>Отправить</button>
                </form>
            </div>
        </div>";
}
?>
<!--вывод коментов и джоим на таблицах-->
<?php
    try {
        // Запрос
        $sql = "SELECT p.id, p.name_tyan, c.comment, c.name, c.date 
                FROM posts AS p
                JOIN comments AS c ON p.id = c.tyan_id
                WHERE c.tyan_id = ?";

        // Подготовка
        /** @var $pdo */
        $query = $pdo->prepare($sql);

        // Отправка
        $query->execute([$tyan_id]);

        // Получение данных
        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        // Проверяем наличие комментариев
        echo $comments ? getComments($comments) : "Пост не найден.";

    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
    function getComments($comments) {
        $output = ''; // Для накопления вывода
        foreach ($comments as $comment) {
            $commentText = htmlspecialchars($comment['comment']);
            $authorName = htmlspecialchars($comment['name']);
            $commentDate = htmlspecialchars($comment['date']);
            // для вывода комментария
            $output .= "
            <div class='container'>
                <div class='mb-4'>
                    <div class='col-md-8 col-lg-6'>
                        <div class='card shadow-lg border-0' style='background-color: #ffffff; border-radius: 15px;  width: 54.5rem;'>
                            <div class='card-body p-3'>
                                <!-- Комментарий -->
                                <div class='card mb-2' style='border: none; background-color: #f8f9fa; border-radius: 10px;'>
                                    <div class='card-body'>
                                        <p class='mb-3' style='font-size: 1.1rem; font-weight: 500;'>Содержание: <span class='fw-bold text-danger'>{$commentText}</span></p>
                                        <div class='d-flex justify-content-between'>
                                            <div class='d-flex flex-row align-items-center'>
                                                <p class='small mb-0 text-muted'>Автор: <span class='fw-bold text-danger'>{$authorName}</span></p>
                                                <p class='small mb-0 text-muted ms-3'>Дата: {$commentDate}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        return $output ?: "Комментариев пока нет.";
    }
?>
<!--//обработка комента-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['comment']) && !empty($_POST['name']) && !empty($_POST['tyan_id'])) {
    $newName = htmlspecialchars($_POST['name']);
    $newComment = htmlspecialchars($_POST['comment']);
    $newTyan = htmlspecialchars($_POST['tyan_id']);

    // Запрос на добавление комментария
    $sql = "INSERT INTO comments (name, comment, tyan_id) VALUES (?, ?, ?)";
    /** @var $pdo */;
    // Подготавливаем запрос
    $query = $pdo->prepare($sql);
    // Выполняем запрос с параметрами
    $query->execute([$newName, $newComment, $newTyan]);

    // Редирект обратно к посту после добавления комментария
    header("Location: singleTrendTyan.php?tyan_id=" . $newTyan);
    exit; // Остановка выполнения скрипта после редиректа
}
?>


<?php require_once(__DIR__ . "/footer.php"); ?>
<script>
    // скрыть показать форму комента ебаную нахуй
    $(document).ready(function (){
        $('#flexSwitchCheckDefault').change(function () {
            // Определяем, установлен ли чекбокс
            let is_true = $(this).is(':checked') ? 1 : 0;
            // показ формы от состояния чекбокса
            if (is_true) {
                $('#form-comment').show(5000);// Показываем
            } else {
                $('#form-comment').hide(5000); // Скрываем
            }
        });
    });
</script>





