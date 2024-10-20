<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php
require_once(__DIR__ . "/../controllers/error.php");
$host = "localhost";
$database = "mini-dataBase";
$user = "root";
$pass = "mirita";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
} catch (PDOException $exception) {
    echo "Error: " . $exception->getMessage();
}