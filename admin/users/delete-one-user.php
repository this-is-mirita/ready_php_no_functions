<?php

// Подключаемся к базе данных
require_once(__DIR__ . "/../../Model/dbConnection.php");

require_once(__DIR__ . "/../../controllers/error.php");

if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    echo $id;
}
$sql = "DELETE FROM users WHERE id= ?";
$query = $pdo->prepare($sql);
$query->execute([$id]);
//http://localhost/first-sait/admin/users/admin-users.php
header('location: admin-users.php');