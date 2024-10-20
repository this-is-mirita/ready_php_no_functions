<?php require_once(__DIR__ . "/../../View/header.php") ?>
<!-- ошибка -->
<?php require_once(__DIR__ . "/../../controllers/error.php") ?>
<!-- датабаза -->
<?php require_once(__DIR__ . "/../../Model/dbConnection.php"); ?>
<?php
try {
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $isAdmin = trim(filter_var($_POST['is_admin'], FILTER_SANITIZE_SPECIAL_CHARS));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "INSERT INTO users(login, username, email, password, is_admin) VALUES (?,?,?,?,?)";
        $query = $pdo->prepare($sql);
        try {
            $query->execute([$login, $username, $email, $password, $isAdmin]);
            header("location: admin-users.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
       echo "error";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



//http://localhost/first-sait/admin/users/admin-users.php
    //
?>
<div class="container mt-5">
    <h2>Создать пользователя</h2>
    <form action="admin-add-user-page.php" method="POST" enctype="multipart/form-data">
        <!-- Логин -->
        <div class="mb-3">
            <label for="loginInput" class="form-label">Логин</label>
            <input type="text" class="form-control" id="loginInput" name="login" placeholder="Введите логин" >
        </div>

        <!-- Имя пользователя -->
        <div class="mb-3">
            <label for="usernameInput" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Введите имя пользователя" >
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="emailInput" class="form-label">Email</label>
            <input type="" class="form-control" id="emailInput" name="email" placeholder="Введите email" >
        </div>

        <!-- Пароль -->
        <div class="mb-3">
            <label for="passwordInput" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Введите пароль" >
        </div>

        <!-- Является администратором (is_admin) -->
        <div class="mb-3">
            <label for="isAdminInput" class="form-label">Администратор</label>
            <select class="form-select" id="isAdminInput" name="is_admin" >
                <option value="0">Нет</option>
                <option value="1">Да</option>
            </select>
        </div>

        <!-- Кнопка отправки -->
        <button type="submit" class="btn btn-primary">Создать пользователя</button>
    </form>
</div>

