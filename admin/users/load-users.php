<?php


// Подключаемся к базе данных
require_once(__DIR__ . "/../../Model/dbConnection.php");

// Проверяем, что запрос был методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Получаем значение фильтра (1 - только админы, 0 - все пользователи)
    $is_admin = isset($_POST['is_admin']) ? (int)$_POST['is_admin'] : 0;

    // Формируем SQL-запрос в зависимости от фильтра
    if ($is_admin === 1) {
        $sql = "SELECT * FROM users WHERE is_admin = 1";
    } else {
        $sql = "SELECT * FROM users";
    }

    try {
        // Подготавливаем и выполняем запрос
        /** @var $pdo */
        //подгтовка
        $query = $pdo->prepare($sql);
        // выполняем SQL-выражение
        $query->execute();
        //jплучение в переменную
        $users = $query->fetchAll();
        //var_dump($users);
        // Проверяем, есть ли пользователи
        if ($users) {
            // Генерируем HTML для каждого пользователя
            foreach ($users as $row) {
                // htmlspecialchars для предотвращения XSS-атак
                // urlencode для безопасной передачи параметров в URL.
                echo '<div class="row mb-3" users_id="' . htmlspecialchars($row['id']) . '">
                    <div class="col-1">
                        <p class="text-dark fs-5">ID</p>
                        <p>' . htmlspecialchars($row['id']) . '</p>
                    </div>
                    <div class="col-1">
                        <p class="text-dark fs-5">Login</p>
                        <p>' . htmlspecialchars($row['login']) . '</p>
                    </div>
                    <div class="col-2">
                        <p class="text-dark fs-5">Username</p>
                        <p>' . htmlspecialchars($row['username']) . '</p>
                    </div>
                    <div class="col-2">
                        <p class="text-dark fs-5">Email</p>
                        <p>' . htmlspecialchars($row['email']) . '</p>
                    </div>
                    <div class="col-2">
                        <p class="text-dark fs-5">Pass</p>
                        <p>' . htmlspecialchars(substr($row['password'], 0, 8)) . '...</p>
                    </div>
                    <div class="col-1">
                        <p class="text-dark fs-5">Admin</p>
                        <p>' . ($row['is_admin'] ? 'Да' : 'Нет') . '</p>
                    </div>
                    <div class="col-3">
                        <!-- удаление пользователя -->
                        <a class="btn btn-dark me-2" href="delete-one-user.php?post_id=' . urlencode($row['id']) . '">Delete</a>
                        
                        <!-- Кнопка для открытия модального окна -->
                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal' . $row['id'] . '">Update</a>
                
                        <!-- Модальное окно -->
                        <div class="modal fade" id="updateModal' . $row['id'] . '" tabindex="-1" aria-labelledby="updateModalLabel' . $row['id'] . '" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel' . $row['id'] . '">Update User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Форма обновления данных пользователя -->
                                        <form action="update-one-user.php" method="POST">
                                            <div class="mb-3">
                                                <label for="userIdInput' . $row['id'] . '" class="form-label">User ID</label>
                                                <input type="text" class="form-control" id="userIdInput' . $row['id'] . '" name="user_id" value="' . htmlspecialchars($row['id']) . '" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="loginInput' . $row['id'] . '" class="form-label">Login</label>
                                                <input type="text" class="form-control" id="loginInput' . $row['id'] . '" name="login" value="' . htmlspecialchars($row['login']) . '" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="usernameInput' . $row['id'] . '" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="usernameInput' . $row['id'] . '" name="username" value="' . htmlspecialchars($row['username']) . '" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailInput' . $row['id'] . '" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="emailInput' . $row['id'] . '" name="email" value="' . htmlspecialchars($row['email']) . '" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="passwordInput' . $row['id'] . '" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="passwordInput' . $row['id'] . '" name="password" value="' . htmlspecialchars($row['password']) . '" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="isAdminInput' . $row['id'] . '" class="form-label">Is Admin</label>
                                                <select class="form-select" id="isAdminInput' . $row['id'] . '" name="is_admin" >
                                                    <option value="0" ' . ($row['is_admin'] == 0 ? 'selected' : '') . '>No</option>
                                                    <option value="1" ' . ($row['is_admin'] == 1 ? 'selected' : '') . '>Yes</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="linkimgInput' . $row['id'] . '" class="form-label">Image Link</label>
                                                <input type="text" class="form-control" id="linkimgInput' . $row['id'] . '" name="linkimg" value="' . $row['linkimg'] . '">
                                            </div>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>';
            }
        } else {
            // Если пользователей нет
            echo '<p class="text-warning">Пользователи не найдены.</p>';
        }
    } catch (PDOException $e) {
        // В случае ошибки выводим сообщение
        echo '<p class="text-danger">Ошибка при получении пользователей: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
} else {
    // Если запрос не методом POST
    echo '<p class="text-danger">Некорректный запрос.</p>';
}
?>
<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>