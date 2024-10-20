<!-- шапка -->
<?php require_once(__DIR__ . "/../../View/header.php") ?>
<!-- ошибка -->
<?php require_once(__DIR__ . "/../../controllers/error.php") ?>
<!-- датабаза -->
<?php require_once(__DIR__ . "/../../Model/dbConnection.php"); ?>

<div class="container my-5">
    <div class="row">
        <!--// сайд бар-->
        <div class="col-9">
            <!-- Форма с переключателем чекбокса -->
            <a href="../admin-start-page.php" class="btn btn-dark px-5 mb-4">вернуться назад</a>
            <a href="admin-add-user-page.php" class="btn btn-dark px-5 mb-4">Добавить пользователя</a>
            <form id="admin-filter-form">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">admins</label>
                </div>
            </form>

            <!-- Контейнер для списка пользователей -->
            <div id="user-list">
                <!--отображается список пользователей, загруженный через AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Скрипт для обработки переключения чекбокса -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Функция для загрузки пользователей
        function loadUsers(isAdmin) {
            $.ajax({
                url: 'load-users.php', // Файл для обработки AJAX-запроса
                method: 'POST',        // Метод отправки данных (POST)
                data: {is_admin: isAdmin}, // Данные, которые отправляем на сервер
                beforeSend: function() {
                    // Показываем индикатор загрузки (опционально)
                    $('#user-list').html('<p>Загрузка...</p>');
                },
                success: function (response) {
                    // Обновляем содержимое контейнера с пользователями
                    $('#user-list').html(response);
                },
                error: function (xhr, status, error) {
                    // Если произошла ошибка, выводим сообщение в консоль и на страницу
                    console.error('Ошибка AJAX-запроса:', xhr.responseText);
                    $('#user-list').html('<p class="text-danger">Произошла ошибка при загрузке пользователей.</p>');
                }
            });
        }

        // Загружаем полный список пользователей при загрузке страницы
        loadUsers(0);

        // Обрабатываем переключение чекбокса
        $('#flexSwitchCheckDefault').change(function () {
            // Определяем, установлен ли чекбокс
            let isAdmin = $(this).is(':checked') ? 1 : 0;
            // Загружаем пользователей в зависимости от состояния чекбокса
            loadUsers(isAdmin);
        });
    });
</script>
<?php
/*
Разберём твою функцию на простом языке:

$(document).ready(function () { ... });
Этот код означает: "Запусти вот эту часть (всё, что внутри фигурных скобок), как только вся HTML-страница загрузится."
Это важно, чтобы начать работать с элементами на странице, когда они уже видимы.

function loadUsers(isAdmin) { ... }
Это объявление функции, которая загружает список пользователей с сервера.
Внутри функции есть код для отправки запроса на сервер с помощью AJAX.

$.ajax({ ... });
$.ajax — это способ отправить запрос на сервер (например, чтобы получить или отправить данные без перезагрузки страницы).
url: 'load-users.php' — это адрес на сервере, куда отправляется запрос.
method: 'POST' — метод запроса (в данном случае POST, чтобы передать данные).
data: {is_admin: isAdmin} — здесь мы передаём данные в запросе. В данном случае это информация,
админы или все пользователи нужны (1 — админы, 0 — все).

success: function (response) { ... }
Это часть кода, которая выполняется, если запрос прошёл успешно.
$('#user-list').html(response); — найденные на сервере данные (список пользователей) загружаются в HTML
элемент с id="user-list". То есть сервер вернёт список, и этот список заменит содержимое внутри блока с id="user-list".

error: function (xhr, status, error) { ... }
Если что-то пойдёт не так (например, сервер не ответит), эта часть кода покажет сообщение об ошибке.

loadUsers(0);
Эта строка сразу при загрузке страницы вызывает функцию loadUsers(0), что значит:
"Загрузи всех пользователей" (0 — это для всех пользователей, а не только админов).

$('#flexSwitchCheckDefault').change(function () { ... });
Эта часть кода говорит: "Когда пользователь переключает чекбокс, вызывай функцию loadUsers
и передавай в неё значение — 1 (если чекбокс включен) или 0 (если выключен)".
Если коротко: эта функция отправляет запрос на сервер, получает список пользователей
(в зависимости от состояния чекбокса), и отображает их на странице без перезагрузки.
*/
?>