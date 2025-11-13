<?php


require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

try {
    // Создаем объект Dotenv и загружаем переменные
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load(); // Запускаем загрузку переменных
} catch (\Exception $e) {
    die('Error loading environment variables: ' . $e->getMessage());
}


$host = $_ENV['HOST'];
$name = $_ENV['DB_NAME'];
$user = $_ENV['LOGIN'];
$pass = $_ENV['PASSWORD'];
$charset = 'utf8';

$dsn = "mysql:host=$host; dbname=$name; charset=$charset";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

